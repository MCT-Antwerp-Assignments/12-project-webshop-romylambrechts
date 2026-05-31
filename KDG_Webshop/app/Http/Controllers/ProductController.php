<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function home()
    {
        $products = Product::all();

        return view('home', [
            'products' => $products
        ]);
    }

    public function index()
    {
        $products = Product::all();
        return view('products', [
            'products' => $products
        ]);
    }

    public function show($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        return view('product', [
            'product' => $product
        ]);
    }
}
