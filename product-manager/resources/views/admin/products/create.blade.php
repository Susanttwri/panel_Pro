@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
    <div style="max-width: 720px;">
        <div class="card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 style="font-size: 18px; font-weight: 700; color: #f1f5f9;">Add New Product</h2>
            </div>

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Product Name *</label>
                    <input type="text" id="name" name="name" class="form-control"
                           placeholder="e.g. Wireless Headphones" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"
                              placeholder="Write a detailed product description...">{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price ($) *</label>
                        <input type="number" id="price" name="price" class="form-control"
                               placeholder="0.00" step="0.01" min="0" value="{{ old('price') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" class="form-control"
                               placeholder="0" min="0" value="{{ old('quantity', 0) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    <div class="file-input-wrapper">
                        <input type="file" id="image" name="image" accept="image/*">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload or drag and drop<br><small>PNG, JPG, GIF, WebP up to 2MB</small></p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="is_active" name="is_active" value="1" checked>
                        <label for="is_active" style="margin-bottom: 0;">Active (visible on frontend)</label>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 28px;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Create Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
