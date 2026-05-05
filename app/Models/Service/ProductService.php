<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function store(array $data)
    {
        return Product::create($data);
    }
}