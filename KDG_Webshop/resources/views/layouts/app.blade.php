<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

<nav class="bg-black text-white p-4 flex justify-between items-center">
    <a href="/" class="text-xl font-bold">KDG webshop</a>

    <div class="flex gap-6">
        <a href="/products" class="hover:underline">Products</a>
        <a href="/cart" class="hover:underline">Cart</a>
        <a href="/contact" class="hover:underline">Contact</a>
    </div>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>