@extends('layouts.app')

@section('content')

  <div class="bg-white">
    <div class="relative overflow-hidden bg-white">
      <div class="pt-16 pb-20 sm:pt-24 sm:pb-32 lg:pt-32 lg:pb-40">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div class="flex items-center justify-between">
            <div class="sm:max-w-lg">
              <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                KDG Shop
              </h1>
              <p class="mt-4 text-xl text-gray-500">
                Discover our exclusive collection of hoodies, bags and caps.
              </p>
              <div class="mt-8">
                <a href="/products"
                  class="inline-block rounded-md bg-indigo-600 px-6 py-3 text-white hover:bg-indigo-700">
                  Shop now
                </a>
              </div>
            </div>
            <div class="hidden md:block ml-12">
              <img src="{{ asset('images/kdg-logo.png') }}" class="h-24 w-auto opacity-90">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mx-auto max-w-7xl px-6 lg:px-8 pb-20">
      <h2 class="text-2xl font-bold text-gray-900 mb-6">
        Featured products
      </h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
          <a href="/product/{{ $product->id }}" class="block border rounded-lg overflow-hidden hover:shadow-lg transition">
            <img src="{{ asset('storage/products/' . explode(',', $product->photo)[0]) }}" class="h-64 w-full object-cover">
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
    </div>
  </div>
@endsection