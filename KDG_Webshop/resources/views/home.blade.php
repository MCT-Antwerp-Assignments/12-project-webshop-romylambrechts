<h1>Products</h1>

@if($products->isEmpty())
    <p>No products found</p>
@else
    @foreach($products as $product)
        <div>
            <h2>{{ $product->name }}</h2>
            <p>€ {{ $product->price }}</p>
            <p>Stock: {{ $product->stock }}</p>
        </div>
    @endforeach
@endif