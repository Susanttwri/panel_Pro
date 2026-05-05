@extends('layouts.frontend')

@section('title', 'All Products - PanelsPro')
@section('meta_description', 'Browse our complete collection of premium tech products.')

@section('content')
    <section class="section" style="padding-top: 120px;">
        <div class="section-header">
            <h2>All Products</h2>
            <p>Browse our complete collection of {{ $products->total() }} products</p>
        </div>

        @if($products->count() > 0)
            <div class="product-grid">
                @foreach($products as $product)
                    <a href="{{ route('products.show', $product) }}" class="product-card">
                        <div class="product-card-img">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <i class="fas fa-cube placeholder-icon"></i>
                            @endif
                        </div>
                        <div class="product-card-body">
                            <h3>{{ $product->name }}</h3>
                            <p>{{ Str::limit($product->description, 100) }}</p>
                            <div class="product-card-footer">
                                <div class="product-price">
                                    ${{ number_format($product->price, 2) }}
                                </div>
                                <span class="product-stock {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                    {{ $product->quantity > 0 ? 'In Stock' : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="pagination-wrapper">
                {{ $products->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 60px 20px; color: #64748b;">
                <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 16px; color: rgba(139,92,246,0.3);"></i>
                <h3 style="color: #94a3b8; margin-bottom: 8px;">No Products Found</h3>
                <p>Check back soon for amazing products!</p>
            </div>
        @endif
    </section>
@endsection
