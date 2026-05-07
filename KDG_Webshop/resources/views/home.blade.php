@extends('layouts.app')

@section('content')

<div class="relative overflow-hidden bg-white">
  <div class="pt-16 pb-40 sm:pt-24 sm:pb-40 lg:pt-40 lg:pb-48">
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="sm:max-w-lg">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
          Summer styles are finally here
        </h1>
        <p class="mt-4 text-xl text-gray-500">
          Discover our latest collection of products.
        </p>
      </div>
      <div class="mt-10">
        <a href="/products"
           class="inline-block rounded-md bg-indigo-600 px-8 py-3 text-white hover:bg-indigo-700">
          Shop Collection
        </a>
      </div>

    </div>

  </div>
</div>

@endsection