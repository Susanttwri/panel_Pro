@extends('layouts.student')
@section('title', 'Your Cart — PanelPro Student')

@section('content')
    <h1 class="page-title">Your Cart</h1>
    <p class="page-sub">{{ $items->count() }} course(s) selected</p>

    @if($items->count() > 0)
        <div style="display:grid; gap:14px; margin-bottom:24px;">
            @foreach($items as $course)
                <div style="background:var(--card); border:1px solid var(--border); border-radius:12px; padding:18px 22px; display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
                    <div style="flex:1; min-width:200px;">
                        <div style="font-weight:700;">{{ $course->title }}</div>
                        <div style="font-size:12px; color:var(--muted);">{{ $course->category }} · {{ $course->duration_hours }}h</div>
                    </div>
                    <div style="font-weight:800;">{{ $course->price == 0 ? 'Free' : 'Rs. '.number_format($course->price,0) }}</div>
                    <form action="{{ route('student.cart.remove', $course) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-ghost" style="padding:8px 12px;"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            @endforeach
        </div>
        <div style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:24px;">
            <div style="display:flex; justify-content:space-between; margin-bottom:20px; font-size:18px; font-weight:800;">
                <span>Total</span>
                <span>Rs. {{ number_format($total, 0) }}</span>
            </div>
            <div style="display:flex; gap:12px; flex-wrap:wrap;">
                <a href="{{ route('student.cart.checkout') }}" class="btn btn-primary"><i class="fas fa-lock"></i> Checkout</a>
                <a href="{{ route('student.courses') }}" class="btn btn-ghost">Continue Shopping</a>
                <form action="{{ route('student.cart.clear') }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-ghost">Clear Cart</button>
                </form>
            </div>
        </div>
    @else
        <div style="text-align:center; padding:60px; background:var(--card); border-radius:14px; border:1px dashed var(--border);">
            <p style="color:var(--muted); margin-bottom:20px;">Your cart is empty.</p>
            <a href="{{ route('student.courses') }}" class="btn btn-primary">Browse Courses</a>
        </div>
    @endif
@endsection
