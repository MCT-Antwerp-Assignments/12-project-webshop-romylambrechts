@extends('layouts.app')
@section('content')

  <div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
      <h2 class="text-2xl font-bold tracking-tight text-gray-900">
        Products
      </h2>
      <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

        @foreach($products as $product)

          <div class="group relative border p-3 rounded-lg">
            @php
              $photos = explode(',', $product->photo);
            @endphp
            <div class="relative overflow-hidden rounded-md">
              <a href="/product/{{ $product->id }}" class="block relative overflow-hidden rounded-md">

                @foreach($photos as $index => $photo)
                  <img src="{{ asset('storage/products/' . trim($photo)) }}"
                    class="product-image aspect-square w-full object-cover lg:h-80 {{ $index != 0 ? 'hidden' : '' }}"
                    alt="{{ $product->name }}">
                @endforeach

              </a>
            </div>
            <div class="mt-4 flex justify-between">
              <div>
                <h3 class="text-sm text-gray-700">
                  <a href="/product/{{ $product->id }}">
                    {{ $product->name }}
                  </a>
                </h3>

                <!-- <p class="mt-1 text-sm text-gray-500">
                      Stock: {{ $product->stock }}
                    </p> -->
              </div>

              <p class="text-sm font-medium text-gray-900">
                € {{ $product->price }}
              </p>
            </div>

            <form method="POST" action="/cart/add" class="mt-3">
              @csrf
              <input type="hidden" name="product_id" value="{{ $product->id }}">

              <button class="bg-black text-white px-3 py-1 rounded w-full">
                Add to cart
              </button>
            </form>
          </div>
        @endforeach
      </div>
    </div>
  </div>
  <script>
    document.querySelectorAll('.group').forEach(group => {      //foto carrousel

      const images = group.querySelectorAll('.product-image');
      let current = 0;

      if (images.length > 1) {
        setInterval(() => {
          images[current].classList.add('hidden');
          current = (current + 1) % images.length;
          images[current].classList.remove('hidden');
        }, 2000);
      }
    });
  </script>

@endsection