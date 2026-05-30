<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-white">
    <nav class="bg-black text-white p-4 flex justify-between items-center">
        <a href="/" class="text-xl font-bold">KDG webshop</a>

        <div class="flex gap-6">
            <a href="/products" class="hover:underline">Products</a>
            <a href="/cart" class="hover:underline">Cart</a>
            <a href="/contact" class="hover:underline">Contact</a>
        </div>
    </nav>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="bg-gray-900 text-white mt-auto">
        <div class="mx-auto max-w-7xl px-6 py-10 grid grid-cols-1 md:grid-cols-3 gap-60">
            <div>
                <h3 class="text-lg font-semibold">KDG Shop</h3>
                <p class="mt-2 text-gray-400 text-sm">
                    Exclusive student webshop.
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold">Contact</h3>
                <p class="mt-2 text-gray-400 text-sm">
                    Email: info@kdgshop.be<br>
                    Phone: +32 000 00 00 00
                </p>
            </div>

            <div>
                <h3 class="text-lg font-semibold">Links</h3>
                <ul class="mt-2 space-y-2 text-gray-400 text-sm">
                    <li><a href="/" class="hover:text-white">Home</a></li>
                    <li><a href="/products" class="hover:text-white">Products</a></li>
                    <li><a href="/cart" class="hover:text-white">Cart</a></li>
                    <li><a href="/contact" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-700 text-center py-4 text-gray-500 text-sm">
            © {{ date('Y') }} KDG Shop. All rights reserved.
        </div>

    </footer>
</body>
</html>