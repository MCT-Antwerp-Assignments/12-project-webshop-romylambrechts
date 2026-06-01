@extends('layouts.app')
@section('content')

<div class="bg-white min-h-screen flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-green-600">
            Payment successful!
        </h1>

        <p class="mt-4 text-gray-500">
            Thank you for your order.
        </p>

        <a href="/"
           class="mt-6 inline-block rounded-md bg-indigo-600 px-6 py-3 text-white hover:bg-indigo-700">
            Back to home
        </a>
    </div>
</div>
@endsection