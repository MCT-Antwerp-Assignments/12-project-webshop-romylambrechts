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
                    <ul role="list" class="border-t border-gray-200">

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

                                            @if(!empty($cartItem['size']))
                                                <p class="text-xs text-gray-500">
                                                    Size: {{ $cartItem['size'] }}
                                                </p>
                                            @endif
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
                    <div class="mt-10 border-t pt-6 flex justify-between text-lg font-semibold">
                        <span>Total</span>
                        <span>€ {{ number_format($total, 2) }}</span>
                    </div>
                </section>

                <form method="POST" action="{{ route('payment.pay') }}" class="mt-10 border-t pt-6">
                    @csrf
                    <br>
                    <h2 class="text-lg font-semibold mb-4">Checkout data</h2>
                    @if(session('error'))
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif
                    <input type="text" name="firstname" placeholder="First name" class="border p-2 w-full mb-2" required>
                    <input type="text" name="lastname" placeholder="Last name" class="border p-2 w-full mb-2" required>
                    <input type="email" name="email" placeholder="Email" class="border p-2 w-full mb-2" required>

                    <input type="text" name="street" placeholder="Street" class="border p-2 w-full mb-2" required>
                    <input type="text" name="nr" placeholder="Nr" class="border p-2 w-full mb-2" required>
                    <input type="text" name="box" placeholder="Box (optional)" class="border p-2 w-full mb-2">

                    <input type="text" name="zip" placeholder="ZIP" class="border p-2 w-full mb-2" required>
                    <input type="text" name="city" placeholder="City" class="border p-2 w-full mb-2" required>
                    <input type="text" name="country" placeholder="Country" class="border p-2 w-full mb-2" required>
                    <br><br>
                    <button class="w-full bg-black text-white py-3 rounded">
                        Pay
                    </button>
                </form>
                <br><br>
            </div>
        </main>
    </div>
@endsection