<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductColtroller extends Controller
{
    public function index() {
        $products = Product::getProductsInStock()->latest()->paginate(10);

        return view('index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('create-sale');
    }
}
