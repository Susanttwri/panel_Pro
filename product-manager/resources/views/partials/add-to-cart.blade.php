@php
    $cart = app(\App\Services\CartService::class);
    $canBuy = $cart->canPurchase($course);
    $btnPrimary = 'display:inline-flex; align-items:center; gap:8px; padding:10px 16px; font-size:13px; border:none; cursor:pointer; border-radius:10px; font-weight:700; font-family:Inter,sans-serif; text-decoration:none; background:linear-gradient(135deg,#000,#333); color:#fff;';
    $btnGhost = 'display:inline-flex; align-items:center; gap:8px; padding:10px 16px; font-size:13px; border-radius:10px; font-weight:600; font-family:Inter,sans-serif; text-decoration:none; background:#fff; color:#111; border:1px solid #e5e7eb;';
@endphp

@guest
    @if($canBuy)
        <a href="{{ route('student.login') }}" style="{{ $btnPrimary }}">
            <i class="fas fa-sign-in-alt"></i> Login to Enroll
        </a>
    @else
        <button type="button" style="{{ $btnPrimary }} opacity:.5; cursor:not-allowed;" disabled>
            <i class="fas fa-ban"></i> Unavailable
        </button>
    @endif
@else
    @if(auth()->user()->isStudent())
        @if($canBuy)
            @if($cart->isInCart($course->id))
                <a href="{{ route('student.cart.index') }}" style="{{ $btnGhost }}">
                    <i class="fas fa-check"></i> In Cart — View
                </a>
            @else
                <form action="{{ route('student.cart.add', $course) }}" method="POST" style="display:inline; margin:0;">
                    @csrf
                    <button type="submit" style="{{ $btnPrimary }}">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
            @endif
        @else
            <button type="button" style="{{ $btnPrimary }} opacity:.5; cursor:not-allowed;" disabled>
                <i class="fas fa-ban"></i> Unavailable
            </button>
        @endif
    @else
        <a href="{{ route('admin.dashboard') }}" style="{{ $btnGhost }}">Admin account — use student login</a>
    @endif
@endguest
