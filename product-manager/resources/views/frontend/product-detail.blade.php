@extends('layouts.frontend')

@section('title', $product->name . ' - PanelsPro')
@section('meta_description', Str::limit($product->description, 160))

@section('content')
    <div class="product-detail">
        <div class="product-detail-grid">
            <!-- Product Image -->
            <div class="product-detail-img">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                @else
                    <i class="fas fa-cube placeholder-icon"></i>
                @endif
            </div>

            <!-- Product Info -->
            <div class="product-detail-info">
                <div class="breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span>/</span>
                    <a href="{{ route('products') }}">Products</a>
                    <span>/</span>
                    <span class="current">{{ Str::limit($product->name, 30) }}</span>
                </div>

                <h1>{{ $product->name }}</h1>

                <div class="detail-price">${{ number_format($product->price, 2) }}</div>

                <div class="detail-desc">
                    {{ $product->description ?? 'No description available for this product.' }}
                </div>

                <div class="product-meta">
                    <div class="meta-item">
                        <div class="meta-label">Availability</div>
                        <div class="meta-value" style="color: {{ $product->quantity > 0 ? '#34d399' : '#f87171' }};">
                            {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Stock</div>
                        <div class="meta-value">{{ $product->quantity }} units</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Product ID</div>
                        <div class="meta-value">#{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Added On</div>
                        <div class="meta-value">{{ $product->created_at->format('M d, Y') }}</div>
                    </div>
                </div>

                <a href="{{ route('products') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <section class="related-section">
            <div class="section-header">
                <h2>You May Also Like</h2>
                <p>Check out these related products</p>
            </div>

            <div class="product-grid">
                @foreach($relatedProducts as $related)
                    <a href="{{ route('products.show', $related) }}" class="product-card">
                        <div class="product-card-img">
                            @if($related->image)
                                <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->name }}">
                            @else
                                <i class="fas fa-cube placeholder-icon"></i>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <h3>{{ $related->name }}</h3>
                            <p>{{ Str::limit($related->description, 80) }}</p>
                            <div class="product-card-footer">
                                <div class="product-price">${{ number_format($related->price, 2) }}</div>
                                <span class="product-stock {{ $related->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                    {{ $related->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endsection
