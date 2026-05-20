@extends('layouts.app')
@section('content')

    @php
        $photos = explode(',', $product->photo);
    @endphp

    <div class="bg-white">
        <main class="mx-auto max-w-7xl px-8">
            <div class="mx-auto max-w-4xl pt-16">
                <h1 class="text-3xl font-bold tracking-tight text-gray-900">
                    {{ $product->name }}
                </h1>
                <p class="mt-4 text-sm text-gray-500">
                    Exclusive KDG product!
                </p>
                <div class="mt-12 rounded-lg bg-gray-50 p-8">
                    <section class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div>
                            <div class="w-full max-w-sm mx-auto">
                                <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-100">
                                    <img id="mainImage" src="{{ asset('storage/products/' . trim($photos[0])) }}"
                                        class="h-full w-full object-cover">
                                </div>
                            </div> <!-- foto vaste grootte geven -->
                        </div>
                        <div class="flex gap-3 mt-4">
                            @foreach($photos as $photo)

                                <img src="{{ asset('storage/products/' . trim($photo)) }}" onclick="changeImage(this)"
                                    class="h-20 w-20 object-cover rounded-md cursor-pointer border hover:opacity-70">

                            @endforeach
                        </div>
                </div>

                <div>
                    <div class="text-2xl font-semibold text-gray-900">
                        € {{ $product->price }}
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Stock: {{ $product->stock }}
                    </p>
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-900">
                            Size
                        </label>
                        <div class="mt-2 flex gap-3">
                            @foreach(['S', 'M', 'L', 'XL'] as $size)
                                <button type="button"
                                    class="border px-4 py-2 rounded-md text-sm hover:bg-black hover:text-white">
                                    {{ $size }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <form method="POST" action="/cart/add" class="mt-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button
                            class="w-full rounded-md bg-indigo-600 px-4 py-3 text-base font-medium text-white hover:bg-indigo-700">
                            Add to cart
                        </button>
                    </form>
                </div>
                </section>
            </div>
    </div>
    </main>
    </div>

    <script>
        function changeImage(el) {
            document.getElementById('mainImage').src = el.src;
        }
    </script>

@endsection