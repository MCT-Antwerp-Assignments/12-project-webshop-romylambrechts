<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('cart');
    }

    public function add(Request $request)
    {
        // product toevoege
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