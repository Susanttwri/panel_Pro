@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div style="max-width: 720px;">
        <div class="card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 style="font-size: 18px; font-weight: 700; color: #f1f5f9;">Edit Product</h2>
            </div>

            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Product Name *</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="{{ old('name', $product->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price (Rs.) *</label>
                        <input type="number" id="price" name="price" class="form-control"
                               step="0.01" min="0" value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" class="form-control"
                               min="0" value="{{ old('quantity', $product->quantity) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    @if($product->image)
                        <div class="current-image">
                            <p style="font-size: 12px; color: #64748b; margin-bottom: 8px;">Current Image:</p>
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                        <p style="font-size: 12px; color: #64748b; margin: 8px 0;">Upload a new image to replace:</p>
                    @endif
                    <div class="file-input-wrapper">
                        <input type="file" id="image" name="image" accept="image/*">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload or drag and drop<br><small>PNG, JPG, GIF, WebP up to 2MB</small></p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                               {{ $product->is_active ? 'checked' : '' }}>
                        <label for="is_active" style="margin-bottom: 0;">Active (visible on frontend)</label>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 28px;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
