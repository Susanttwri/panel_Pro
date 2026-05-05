<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PanelsPro</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #0a0a1a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 30%, rgba(139, 92, 246, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 70% 70%, rgba(236, 72, 153, 0.08) 0%, transparent 50%);
            animation: bgRotate 20s linear infinite;
        }

        @keyframes bgRotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .login-card {
            background: rgba(26, 26, 62, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(139, 92, 246, 0.15);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-icon {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            color: white;
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.35);
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 800;
            color: #f1f5f9;
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 14px;
            color: #64748b;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #c4b5fd;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #475569;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 44px;
            background: rgba(15, 15, 35, 0.6);
            border: 1px solid rgba(139, 92, 246, 0.2);
            border-radius: 12px;
            color: #e2e8f0;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.15);
        }

        .form-control::placeholder {
            color: #475569;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
            margin-top: 8px;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 25px rgba(139, 92, 246, 0.4);
        }

        .error-msg {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #f87171;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .back-home {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #64748b;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.2s;
        }

        .back-home:hover {
            color: #c4b5fd;
        }

        .demo-creds {
            margin-top: 24px;
            padding: 16px;
            background: rgba(139, 92, 246, 0.06);
            border: 1px solid rgba(139, 92, 246, 0.1);
            border-radius: 12px;
            text-align: center;
        }

        .demo-creds p {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .demo-creds code {
            display: block;
            font-size: 13px;
            color: #c4b5fd;
            margin: 4px 0;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h1>Admin Login</h1>
                <p>Sign in to manage your products</p>
            </div>

            @if($errors->any())
                <div class="error-msg">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-control"
                               placeholder="admin@admin.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="Enter your password" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="fas fa-arrow-right-to-bracket"></i> Sign In
                </button>
            </form>

            <div class="demo-creds">
                <p>Demo Credentials</p>
                <code>Email: admin@admin.com</code>
                <code>Password: password</code>
            </div>

            <a href="{{ route('home') }}" class="back-home">
                <i class="fas fa-arrow-left"></i> Back to Website
            </a>
        </div>
    </div>
</body>
</html>
