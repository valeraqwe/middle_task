<?php

namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public function getRecentPurchasedProducts()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        return Product::whereHas('purchases', function($query) use ($thirtyDaysAgo) {
            $query->where('created_at', '>=', $thirtyDaysAgo);
        })->get();
    }

    public function getPopularProducts()
    {
        return Cache::remember('popular_products', 60 * 24 * 30, function () {
            return Product::where('purchases_count', '>', 0)
                ->orderBy('purchases_count', 'desc')
                ->take(10)
                ->get();
        });
    }
}
