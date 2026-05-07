@extends('layouts.app')

@section('content')

<h1 class="text-4xl font-bold p-8">
    Products
</h1>

@foreach($products as $product)
    <div class="p-4 border m-4 bg-white">
        <a href="/product/{{ $product->id }}">
            <h2>{{ $product->name }}</h2>
        </a>

        <p>€ {{ $product->price }}</p>
        <p>Stock: {{ $product->stock }}</p>
    </div>
@endforeach

<form method="POST" action="/cart/add">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <button type="submit">
        Add to cart
    </button>
</form>