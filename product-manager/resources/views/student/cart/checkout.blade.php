@extends('layouts.student')
@section('title', 'Checkout — PanelPro Student')

@section('content')
    <h1 class="page-title">Checkout</h1>
    <p class="page-sub">Confirm your details to enroll in {{ $items->count() }} course(s).</p>

    <div style="display:grid; grid-template-columns:1fr 300px; gap:28px; align-items:start;">
        <form action="{{ route('student.cart.checkout.submit') }}" method="POST" style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:28px;">
            @csrf
            @if($errors->any())
                <div class="alert alert-error" style="margin-bottom:16px;">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif
            <label style="display:block; font-size:13px; font-weight:600; margin-bottom:6px;">Full Name *</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required style="width:100%; padding:12px; border:1px solid var(--border); border-radius:8px; margin-bottom:16px;">
            <label style="display:block; font-size:13px; font-weight:600; margin-bottom:6px;">Email</label>
            <input type="email" value="{{ auth()->user()->email }}" readonly style="width:100%; padding:12px; border:1px solid var(--border); border-radius:8px; margin-bottom:16px; background:#f9fafb; color:var(--muted);">
            <label style="display:block; font-size:13px; font-weight:600; margin-bottom:6px;">Phone (optional)</label>
            <input type="text" name="phone" value="{{ old('phone') }}" style="width:100%; padding:12px; border:1px solid var(--border); border-radius:8px; margin-bottom:24px;">
            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Complete Enrollment</button>
        </form>
        <aside style="background:var(--card); border:1px solid var(--border); border-radius:14px; padding:22px;">
            <h3 style="font-size:15px; font-weight:700; margin-bottom:14px;">Order Summary</h3>
            @foreach($items as $course)
                <div style="font-size:13px; padding-bottom:10px; margin-bottom:10px; border-bottom:1px solid var(--border);">
                    <div style="font-weight:600;">{{ $course->title }}</div>
                    <div style="color:var(--muted);">{{ $course->price == 0 ? 'Free' : 'Rs. '.number_format($course->price,0) }}</div>
                </div>
            @endforeach
            <div style="display:flex; justify-content:space-between; font-weight:800; font-size:18px; padding-top:10px;">
                <span>Total</span>
                <span>Rs. {{ number_format($total, 0) }}</span>
            </div>
            <a href="{{ route('student.cart.index') }}" style="display:block; text-align:center; margin-top:14px; font-size:13px; color:var(--muted);">← Back to cart</a>
        </aside>
    </div>
@endsection
