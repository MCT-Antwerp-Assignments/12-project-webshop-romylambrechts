<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function home()
    {
        return view('home');
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
        $product = Product::findOrFail($id);
        return view('product', ['product' => $product]);
    }
}
