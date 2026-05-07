@extends('layouts.app')

@section('content')

<h1>Shopping Cart</h1>

@foreach($cart as $id => $quantity)
    <p>Product ID: {{ $id }}</p>
    <p>Quantity: {{ $quantity }}</p>
@endforeach

@endsection