<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login — PanelPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box} body{font-family:Inter,sans-serif;background:#f9fafb;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
        .card{background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:40px;width:100%;max-width:400px}
        h1{font-size:22px;margin-bottom:6px} p{color:#6b7280;font-size:14px;margin-bottom:24px}
        label{display:block;font-size:13px;font-weight:600;margin-bottom:6px}
        input{width:100%;padding:11px 14px;border:1px solid #d1d5db;border-radius:8px;margin-bottom:16px;font-family:inherit}
        button{width:100%;padding:12px;background:#111;color:#fff;border:none;border-radius:8px;font-weight:600;cursor:pointer}
        .err{background:#fef2f2;color:#991b1b;padding:10px;border-radius:8px;margin-bottom:16px;font-size:13px}
        .links{margin-top:16px;text-align:center;font-size:13px} .links a{color:#111}
    </style>
</head>
<body>
    <div class="card">
        <h1><i class="fas fa-graduation-cap"></i> Student Login</h1>
        <p>Sign in to browse courses and manage your cart.</p>
        @if($errors->any())<div class="err">{{ $errors->first() }}</div>@endif
        @if(session('cart_error'))<div class="err">{{ session('cart_error') }}</div>@endif
        <form method="POST" action="{{ route('student.login.submit') }}">
            @csrf
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Sign In</button>
        </form>
        <div class="links">
            <a href="{{ route('student.register') }}">Create student account</a> ·
            <a href="{{ route('home') }}">Back to site</a> ·
            <a href="{{ route('admin.login') }}">Admin login</a>
        </div>
    </div>
</body>
</html>
