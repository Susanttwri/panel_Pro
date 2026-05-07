<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple"><i class="fas fa-boxes-stacked"></i></div>
            <div class="stat-info">
                <h3><?php echo e(\App\Models\Product::count()); ?></h3>
                <p>Total Products</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green"><i class="fas fa-check-circle"></i></div>
            <div class="stat-info">
                <h3><?php echo e(\App\Models\Product::where('is_active', true)->count()); ?></h3>
                <p>Active Products</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange"><i class="fas fa-pause-circle"></i></div>
            <div class="stat-info">
                <h3><?php echo e(\App\Models\Product::where('is_active', false)->count()); ?></h3>
                <p>Inactive Products</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue"><i class="fas fa-coins"></i></div>
            <div class="stat-info">
                <h3>$<?php echo e(number_format(\App\Models\Product::sum('price'), 0)); ?></h3>
                <p>Total Value</p>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="font-size: 18px; font-weight: 700; color: #f1f5f9;">All Products</h2>
            <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>

        <?php if($products->count() > 0): ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 14px;">
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" class="product-img">
                                    <?php else: ?>
                                        <div class="product-img-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <div class="product-name"><?php echo e($product->name); ?></div>
                                        <div class="product-desc"><?php echo e(Str::limit($product->description, 50)); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="price-tag">$<?php echo e(number_format($product->price, 2)); ?></span></td>
                            <td>
                                <span style="font-weight: 600; color: <?php echo e($product->quantity > 0 ? '#34d399' : '#f87171'); ?>;">
                                    <?php echo e($product->quantity); ?>

                                </span>
                            </td>
                            <td>
                                <?php if($product->is_active): ?>
                                    <span class="badge badge-success">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td style="color: #64748b; font-size: 13px;">
                                <?php echo e($product->created_at->format('M d, Y')); ?>

                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="<?php echo e(route('admin.products.edit', $product)); ?>" class="btn btn-sm btn-warning" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.products.destroy', $product)); ?>" method="POST" class="delete-form"
                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="pagination-wrapper">
                <?php echo e($products->links()); ?>

            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <h3>No Products Yet</h3>
                <p>Start adding products to see them listed here.</p>
                <a href="<?php echo e(route('admin.products.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Your First Product
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Downloads\panel_pro\resources\views/admin/products/index.blade.php ENDPATH**/ ?>