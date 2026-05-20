@extends('layouts.app', ['title' => 'Shopping Cart'])
@section('content')
    <div class="bg-white">
        <main class="mx-auto max-w-7xl px-8">
            <div class="mx-auto max-w-4xl pt-16">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    Shopping Cart
                </h1>
                <section aria-labelledby="cart-heading" class="mt-10">
                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>
                    <ul role="list" class="divide-y divide-gray-200 border-y border-gray-200">

                        @forelse($cart as $cartItem)
                            <li class="flex py-10">
                                <img src="{{ asset('storage/products/' . $cartItem['image']) }}"
                                    class="h-32 w-32 rounded-lg object-cover" alt="{{ $cartItem['name'] }}">
                                <div class="ml-6 flex flex-1 flex-col justify-between">
                                    <div class="flex justify-between">
                                        <div>
                                            <a href="/product/{{ $cartItem['id'] }}"
                                                class="text-sm font-medium text-gray-700 hover:text-gray-400">
                                                {{ $cartItem['name'] }}
                                            </a>

                                            <p class="mt-1 text-sm text-gray-500">
                                                Quantity: {{ $cartItem['quantity'] }}
                                            </p>
                                        </div>

                                        <p class="text-sm font-medium text-gray-900">
                                            €{{ number_format($cartItem['price'] * $cartItem['quantity'], 2) }}
                                        </p>
                                    </div>

                                    <div class="mt-4 flex items-center gap-3">

                                        <form method="POST" action="/cart/update">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $cartItem['id'] }}">
                                            <input type="hidden" name="quantity"
                                                value="{{ max(1, $cartItem['quantity'] - 1) }}">

                                            <button class="px-3 py-1 bg-gray-200 rounded">
                                                -
                                            </button>
                                        </form>

                                        <form method="POST" action="/cart/update">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $cartItem['id'] }}">
                                            <input type="hidden" name="quantity" value="{{ $cartItem['quantity'] + 1 }}">
                                            <button class="px-3 py-1 bg-gray-200 rounded">
                                                +
                                            </button>
                                        </form>

                                        <form method="POST" action="/cart/remove">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $cartItem['id'] }}">
                                            <button class="text-red-500 text-sm ml-4">
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="py-10 text-gray-500">
                                Your shopping cart is empty.
                            </li>
                        @endforelse
                    </ul>
                </section>
            </div>
        </main>
    </div>
@endsection