<?php

namespace App\Http\Controllers;

use App\Models\Product;

class FrontendController extends Controller
{
    /**
     * Display the homepage with featured products.
     */
    public function home()
    {
        $featuredProducts = Product::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home', compact('featuredProducts'));
    }

    /**
     * Display all active products.
     */
    public function products()
    {
        $products = Product::where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('frontend.products', compact('products'));
    }

    /**
     * Display a single product.
     */
    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $relatedProducts = Product::where('is_active', true)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('frontend.product-detail', compact('product', 'relatedProducts'));
    }
}
