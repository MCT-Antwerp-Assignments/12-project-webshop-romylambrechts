<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        return view('cart', [
            'cart' => $cart,
            'total' => $total
        ]);
    }

    public function add(Request $request)
    {
        $product = \App\Models\Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        $size = $request->size; 

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => explode(',', $product->photo)[0] ?? 'default.jpg',
                'quantity' => 1
            ];
        }
        session()->put('cart', $cart);
        return back();
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;

        unset($cart[$id]);
        session()->put('cart', $cart);

        return back();
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->product_id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, (int) $request->quantity);
        }
        session()->put('cart', $cart);

        return back();
    }
}