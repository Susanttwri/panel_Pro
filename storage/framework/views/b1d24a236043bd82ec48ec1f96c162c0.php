<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PanelsPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Inter',sans-serif;background:#f9fafb;min-height:100vh;display:flex;align-items:center;justify-content:center}
        .login-container{width:100%;max-width:400px;padding:20px}
        .login-card{background:#fff;border:1px solid #e5e7eb;border-radius:16px;padding:40px}
        .login-header{text-align:center;margin-bottom:28px}
        .login-icon{width:52px;height:52px;background:#111827;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:22px;color:#fff}
        .login-header h1{font-size:22px;font-weight:700;color:#111827;margin-bottom:4px}
        .login-header p{font-size:14px;color:#6b7280}
        .form-group{margin-bottom:16px}
        .form-group label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px}
        .input-wrapper{position:relative}
        .input-wrapper i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:#9ca3af;font-size:13px}
        .form-control{width:100%;padding:11px 14px 11px 40px;background:#fff;border:1px solid #d1d5db;border-radius:8px;color:#111827;font-size:14px;font-family:'Inter',sans-serif;transition:border-color .15s}
        .form-control:focus{outline:none;border-color:#111827;box-shadow:0 0 0 3px rgba(17,24,39,.08)}
        .form-control::placeholder{color:#9ca3af}
        .btn-login{width:100%;padding:12px;background:#111827;color:#fff;border:none;border-radius:8px;font-size:14px;font-weight:600;font-family:'Inter',sans-serif;cursor:pointer;transition:all .15s;margin-top:6px}
        .btn-login:hover{background:#1f2937}
        .error-msg{background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:10px 14px;margin-bottom:16px;font-size:13px;color:#dc2626;display:flex;align-items:center;gap:8px}
        .back-home{display:block;text-align:center;margin-top:16px;color:#6b7280;text-decoration:none;font-size:13px;transition:color .15s}
        .back-home:hover{color:#111827}
        .demo-creds{margin-top:20px;padding:14px;background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;text-align:center}
        .demo-creds p{font-size:10px;color:#9ca3af;margin-bottom:4px;text-transform:uppercase;letter-spacing:1px;font-weight:600}
        .demo-creds code{display:block;font-size:13px;color:#374151;margin:3px 0}
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon"><i class="fas fa-shield-halved"></i></div>
                <h1>Admin Login</h1>
                <p>Sign in to manage your products</p>
            </div>
            <?php if($errors->any()): ?>
                <div class="error-msg"><i class="fas fa-exclamation-circle"></i> <?php echo e($errors->first()); ?></div>
            <?php endif; ?>
            <form method="POST" action="<?php echo e(route('admin.login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-control" placeholder="admin@admin.com" value="<?php echo e(old('email')); ?>" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                </div>
                <button type="submit" class="btn-login">Sign In</button>
            </form>
            <div class="demo-creds">
                <p>Demo Credentials</p>
                <code>Email: admin@admin.com</code>
                <code>Password: password</code>
            </div>
            <a href="<?php echo e(route('home')); ?>" class="back-home"><i class="fas fa-arrow-left"></i> Back to Website</a>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Lenovo\Downloads\panel_pro\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>