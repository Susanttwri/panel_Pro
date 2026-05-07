<?php $__env->startSection('title', 'PanelsPro - Premium Products'); ?>
<?php $__env->startSection('meta_description', 'Discover premium tech products at PanelsPro. Shop the best gadgets, accessories, and electronics.'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-sparkles"></i>
                New Collection Available
            </div>
            <h1>Premium Products,<br>Curated For You</h1>
            <p>Discover our handpicked selection of premium tech gadgets and accessories. Quality meets innovation in every product we offer.</p>
            <div class="hero-buttons">
                <a href="<?php echo e(route('products')); ?>" class="btn-hero btn-hero-primary">
                    <i class="fas fa-store"></i> Browse Products
                </a>
                <a href="#featured" class="btn-hero btn-hero-outline">
                    <i class="fas fa-arrow-down"></i> See Featured
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="section" id="featured">
        <div class="section-header">
            <h2>Featured Products</h2>
            <p>Our top picks just for you</p>
        </div>

        <?php if($featuredProducts->count() > 0): ?>
            <div class="product-grid">
                <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

            <div style="text-align: center; margin-top: 40px;">
                <a href="<?php echo e(route('products')); ?>" class="btn-hero btn-hero-outline">
                    View All Products <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 60px 20px; color: #6b7280;">
                <i class="fas fa-box-open" style="font-size: 40px; margin-bottom: 12px; color: #d1d5db;"></i>
                <h3 style="color: #6b7280; margin-bottom: 6px;">No Products Yet</h3>
                <p>Check back soon for amazing products!</p>
            </div>
        <?php endif; ?>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Lenovo\Downloads\panel_pro\resources\views/frontend/home.blade.php ENDPATH**/ ?>