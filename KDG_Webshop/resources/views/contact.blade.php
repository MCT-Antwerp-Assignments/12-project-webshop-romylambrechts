@extends('layouts.app')
@section('content')

<div class="bg-white">
    <main class="mx-auto max-w-7xl px-8">
        <div class="mx-auto max-w-4xl pt-16">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Contact Us</h1>

            <p class="mt-4 text-sm text-gray-500">
                Got a technical issue? Want to send feedback? Need more details? Let us know.
            </p>
            @if(session('success'))
                <div class="mb-6 rounded-md bg-green-100 p-4 text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf

                <div class="rounded-lg bg-gray-50 p-8">
                    <section aria-labelledby="contact-heading">
                        <h2 id="contact-heading" class="sr-only">Contact form</h2>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-900">
                                Your email
                            </label>
                            <input type="email" id="email" name="email" placeholder="name@example.com" required
                                class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        </div>

                        <div class="mt-4">
                            <label for="subject" class="block text-sm font-medium text-gray-900">
                                Subject
                            </label>
                            <input type="text" id="subject" name="subject" placeholder="Let us know how we can help you"
                                required
                                class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 focus:outline-none">
                        </div>

                        <div class="mt-4">
                            <label for="message" class="block text-sm font-medium text-gray-900">
                                Your message
                            </label>
                            <textarea id="message" name="message" rows="6" placeholder="Leave a comment..." required
                                class="mt-2 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600 focus:outline-none"></textarea>
                        </div>
                    </section>
                </div>

                <button type="submit"
                    class="mt-10 w-full rounded-md bg-indigo-600 px-4 py-3 text-base font-medium text-white hover:bg-indigo-700">
                    Send message
                </button>

                <p class="mt-6 text-center text-sm text-gray-500">
                    or
                    <a href="/" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Back to home <span aria-hidden="true">&rarr;</span>
                    </a>
                </p>
            </form>
        </div>
    </main>
</div>

@endsection