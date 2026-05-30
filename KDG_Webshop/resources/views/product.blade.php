@extends('layouts.app')
@section('content')

    @php
        $photos = explode(',', $product->photo);
    @endphp

    <div class="bg-white">
        <main class="mx-auto max-w-7xl px-8 py-16">

            <div class="mx-auto max-w-4xl">
                <h1 class="text-3xl font-bold text-gray-900">
                    {{ $product->name }}
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Exclusive KDG product!
                </p>
            </div>

            <div class="mt-10 grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
                <div>
                    <div class="aspect-square w-full overflow-hidden rounded-lg bg-gray-100">
                        <img id="mainImage" src="{{ asset('storage/products/' . trim($photos[0])) }}"
                            class="h-full w-full object-cover">
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

                    <!--<p class="mt-2 text-sm text-gray-500">
                        Stock: {{ $product->stock }}
                    </p> -->

                    @if($product->category == 'hoodie')
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-900">
                                Size
                            </label>

                            <div class="mt-2 flex gap-3">
                                @foreach(['S', 'M', 'L', 'XL'] as $size)
                                    <div>
                                        <input type="radio" name="size" value="{{ $size }}" id="size_{{ $size }}"
                                            class="hidden peer" required>
                                        <label for="size_{{ $size }}" class="border px-4 py-2 rounded-md text-sm cursor-pointer
                                          peer-checked:bg-black peer-checked:text-white
                                          block">
                                        {{ $size }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="/cart/add" class="mt-8">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="size" id="selectedSize">
                        <button class="w-full rounded-md bg-indigo-600 px-4 py-3 text-white hover:bg-indigo-700">
                            Add to cart
                        </button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        function changeImage(el) {
            document.getElementById('mainImage').src = el.src;
        }

        document.querySelectorAll('input[name="size"]').forEach(el => {
            el.addEventListener('change', function () {
                document.getElementById('selectedSize').value = this.value;
            });
        });
    </script>
@endsection