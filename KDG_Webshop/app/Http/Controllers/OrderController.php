<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        // order opslage en molliee
    }
}
