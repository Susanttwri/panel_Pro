<?php $__env->startSection('title', 'All Products - PanelsPro'); ?>
<?php $__env->startSection('meta_description', 'Browse our complete collection of premium tech products.'); ?>

<?php $__env->startSection('content'); ?>
    <section class="section" style="padding-top: 120px;">
        <div class="section-header">
            <h2>All Products</h2>
            <p>Browse our complete collection of <?php echo e($products->total()); ?> products</p>
        </div>

        <?php if($products->count() > 0): ?>
            <div class="product-grid">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('products.show', $product)); ?>" class="product-card">
                        <div class="product-card-img">
                            <?php if($product->image): ?>
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                                <i class="fas fa-cube placeholder-icon"></i>
                            <?php endif; ?>
                        </div>
                        <div class="product-card-body">
                            <h3><?php echo e($product->name); ?></h3>
                            <p><?php echo e(Str::limit($product->description, 100)); ?></p>
                            <div class="product-card-footer">
                                <div class="product-price">
                                    $<?php echo e(number_format($product->price, 2)); ?>

                                </div>
                                <span class="product-stock <?php echo e($product->quantity > 0 ? 'in-stock' : 'out-of-stock'); ?>">
                                    <?php echo e($product->quantity > 0 ? 'In Stock' : 'Out of Stock'); ?>

                                </span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="pagination-wrapper">
                <?php echo e($products->links()); ?>

            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 60px 20px; color: #6b7280;">
                <i class="fas fa-box-open" style="font-size: 40px; margin-bottom: 12px; color: #d1d5db;"></i>
                <h3 style="color: #6b7280; margin-bottom: 6px;">No Products Found</h3>
                <p>Check back soon for amazing products!</p>
            </div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Downloads\panel_pro\resources\views/frontend/products.blade.php ENDPATH**/ ?>