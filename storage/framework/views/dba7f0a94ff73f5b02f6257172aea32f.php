<?php $__env->startSection('title', 'Edit Product'); ?>

<?php $__env->startSection('content'); ?>
    <div style="max-width: 720px;">
        <div class="card">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 28px;">
                <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-sm btn-outline">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 style="font-size: 18px; font-weight: 700; color: #f1f5f9;">Edit Product</h2>
            </div>

            <form action="<?php echo e(route('admin.products.update', $product)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="form-group">
                    <label for="name">Product Name *</label>
                    <input type="text" id="name" name="name" class="form-control"
                           value="<?php echo e(old('name', $product->name)); ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control"><?php echo e(old('description', $product->description)); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price ($) *</label>
                        <input type="number" id="price" name="price" class="form-control"
                               step="0.01" min="0" value="<?php echo e(old('price', $product->price)); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity *</label>
                        <input type="number" id="quantity" name="quantity" class="form-control"
                               min="0" value="<?php echo e(old('quantity', $product->quantity)); ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    <?php if($product->image): ?>
                        <div class="current-image">
                            <p style="font-size: 12px; color: #64748b; margin-bottom: 8px;">Current Image:</p>
                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
                        </div>
                        <p style="font-size: 12px; color: #64748b; margin: 8px 0;">Upload a new image to replace:</p>
                    <?php endif; ?>
                    <div class="file-input-wrapper">
                        <input type="file" id="image" name="image" accept="image/*">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <p>Click to upload or drag and drop<br><small>PNG, JPG, GIF, WebP up to 2MB</small></p>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="is_active" name="is_active" value="1"
                               <?php echo e($product->is_active ? 'checked' : ''); ?>>
                        <label for="is_active" style="margin-bottom: 0;">Active (visible on frontend)</label>
                    </div>
                </div>

                <div style="display: flex; gap: 12px; margin-top: 28px;">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update Product
                    </button>
                    <a href="<?php echo e(route('admin.products.index')); ?>" class="btn btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Downloads\panel_pro\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>