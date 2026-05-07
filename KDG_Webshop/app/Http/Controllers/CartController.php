<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart', [
            'cart' => $cart
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
        // verwijdere
    }

    public function update(Request $request)
    {
        // aantal aanpasse
    }
}