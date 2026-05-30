@extends('layouts.app')
@section('content')

  <div class="bg-white">

    <div class="relative bg-cover bg-center bg-no-repeat min-h-[450px]"
      style="background-image: url('{{ asset('images/kdg-gebouw.webp') }}');">
      <div class="absolute inset-0 bg-white/45"></div>

      <div class="relative">
        <div class="pt-28 pb-16 sm:pt-32 sm:pb-20 lg:pt-40 lg:pb-24">
          <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="flex items-center justify-between">
              <div class="sm:max-w-lg border border-gray-300 rounded-lg p-6 bg-white/30 backdrop-blur-sm">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                  KDG Shop
                </h1>
                <p class="mt-4 text-xl text-gray-700">
                  Discover our exclusive collection of hoodies, bags and caps.
                </p>
                <div class="mt-8">
                  <a href="/products"
                    class="inline-block rounded-md bg-blue-800 px-6 py-3 text-white hover:bg-indigo-700">
                    Shop now
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br>
    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-20">
      <h2 class="text-3xl font-bold text-gray-900 mb-6">
        Featured products
      </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
          <a href="/product/{{ $product->id }}" class="block border rounded-lg overflow-hidden hover:shadow-lg transition">
            <img src="{{ asset('storage/products/' . explode(',', $product->photo)[0]) }}"  loading="lazy"
              class="h-100 w-full object-cover">
            <div class="p-4">
              <h3 class="font-medium text-gray-900">
                {{ $product->name }}
              </h3>

              <p class="text-gray-500">
                € {{ $product->price }}
              </p>
            </div>
          </a>
        @endforeach
      </div>
      <br><br><br>
      <div class="hidden md:flex items-center justify-center ml-12">
        <img src="{{ asset('images/kdg-logo.webp') }}"  loading="lazy" class="h-24 w-auto opacity-90">
      </div>
    </div>
  </div>

@endsection