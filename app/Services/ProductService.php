<?php

namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;

class ProductService
{
    public function getRecentPurchasedProducts()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(30);

        return Product::whereHas('purchases', function($query) use ($thirtyDaysAgo) {
            $query->where('created_at', '>=', $thirtyDaysAgo);
        })->get();
    }
}
