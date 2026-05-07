@extends('layouts.app')
@section('content')

<h1 class="text-3xl font-bold p-6">Shopping cart</h1>

@if(empty($cart))
    <p class="p-6">Your cart is empty</p>
@else

<div class="p-6 space-y-4">

@foreach($products as $product)

@php
    $quantity = $cart[$product->id];
@endphp

<div class="border p-4 flex justify-between items-center">

    <div>
        <h2>{{ $product->name }}</h2>
        <p>€ {{ $product->price }}</p>
    </div>

    <div class="flex items-center gap-2">

        <form method="POST" action="/cart/update">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="{{ $quantity - 1 }}">
            <button class="px-2 bg-gray-200">-</button>
        </form>

        <span>{{$quantity}}</span>

        <form method="POST" action="/cart/update">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="{{ $quantity  + 1 }}">

            <button class="px-2 bg-gray-200">+</button>
        </form>

    </div>

    <form method="POST" action="/cart/remove">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <button class="text-red-500">Remove</button>
    </form>

</div>
@endforeach
</div>
@endif
@endsection
