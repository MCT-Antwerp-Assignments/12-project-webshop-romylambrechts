{{-- validation error --}}
@props([
    'name'
])

@error($name ?? null)
    <p class="error">{{ $message }}</p>
@enderror