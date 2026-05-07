<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $productIds = array_keys($cart);
        $products = \App\Models\Product::whereIn('id', $productIds)->get();

        return view('cart', [
            'cart' => $cart,
            'products' => $products
        ]);
    }

    public function add(Request $request)
    {
        $id = $request->product_id;

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $id = $request->product_id;
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $id = $request->product_id;
        $quantity = $request->quantity;
        $cart = session()->get('cart', []);
        if ($quantity <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id] = $quantity;
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }
}