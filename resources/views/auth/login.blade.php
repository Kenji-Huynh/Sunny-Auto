<!-- filepath: d:\Website Sunny Oto\laravel\resources\views\auth\login.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập - Sunny Auto Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            width: 100vw;
            height: 100vh;
            background: white;
            overflow: hidden;
        }

        .form-section {
            padding: 40px 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 560px;
            margin: 0 auto;
            width: 100%;
            overflow-y: auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        .form-section::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        .logo {
            margin-bottom: 80px;
        }

        .logo img {
            height: 45px;
            width: auto;
        }

        .header-text {
            margin-bottom: 32px;
        }

        .header-text small {
            color: #6b7280;
            font-size: 14px;
            font-weight: 400;
            display: block;
            margin-bottom: 8px;
        }

        .header-text h1 {
            color: #111827;
            font-size: 30px;
            font-weight: 600;
            line-height: 1.2;
        }

        .form-wrapper {
            width: 100%;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-group label {
            position: absolute;
            left: 16px;
            top: -8px;
            background: white;
            padding: 0 6px;
            color: #6b7280;
            font-size: 13px;
            font-weight: 400;
            z-index: 1;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 14px 44px 14px 16px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #111827;
            transition: all 0.2s ease;
            background: #fff;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder {
            color: #9ca3af;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: orangered;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 16px;
            pointer-events: none;
        }

        .error-message {
            color: #ef4444;
            font-size: 12px;
            margin-top: 6px;
        }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: orangered;
            color: white;
            border: 2px solid orangered;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 8px;
        }

        .btn-login:hover {
            background: white;
            color: orangered;
            border-color: orangered;
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        .divider {
            text-align: center;
            margin: 28px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e5e7eb;
        }

        .divider span {
            background: white;
            padding: 0 16px;
            color: #9ca3af;
            font-size: 13px;
            position: relative;
            font-weight: 400;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 32px;
        }

        .social-btn {
            padding: 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-btn:hover {
            border-color: #d1d5db;
            background: #f9fafb;
        }

        .footer-text {
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }

        .footer-text a {
            color: orangered;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .image-section {
            background: url('{{ asset('imgs/products/unnamed (1).jpg') }}') center/cover no-repeat;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.2) 0%, rgba(102, 126, 234, 0.2) 100%);
        }

        @media (max-width: 968px) {
            .container {
                grid-template-columns: 1fr;
                height: auto;
                min-height: 100vh;
            }

            .image-section {
                display: none;
            }

            .form-section {
                padding: 32px 24px;
                max-width: 100%;
                height: auto;
                min-height: 100vh;
            }

            .logo {
                margin-bottom: 48px;
            }

            .logo img {
                height: 38px;
            }

            .header-text {
                margin-bottom: 28px;
            }

            .header-text h1 {
                font-size: 26px;
            }

            .form-group {
                margin-bottom: 20px;
            }

            input[type="email"],
            input[type="password"] {
                padding: 13px 44px 13px 14px;
                font-size: 16px;
            }

            .btn-login {
                padding: 14px;
                font-size: 16px;
            }

            .social-buttons {
                gap: 10px;
            }

            .social-btn {
                padding: 12px;
            }

            .divider {
                margin: 24px 0;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 24px 20px;
            }

            .logo {
                margin-bottom: 40px;
            }

            .logo img {
                height: 35px;
            }

            .header-text h1 {
                font-size: 24px;
            }

            .header-text small {
                font-size: 13px;
            }

            .form-group label {
                font-size: 12px;
            }

            input[type="email"],
            input[type="password"] {
                padding: 12px 40px 12px 12px;
                font-size: 16px;
            }

            .btn-login {
                padding: 13px;
            }

            .social-buttons {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .social-btn {
                padding: 10px;
            }

            .footer-text {
                font-size: 13px;
            }
        }

        /* Alert Popup Styles */
        .alert-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }

        .alert-box {
            background: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.3s ease;
            text-align: center;
        }

        @keyframes slideUp {
            from { 
                transform: translateY(50px);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }

        .alert-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-icon svg {
            width: 32px;
            height: 32px;
            color: #ef4444;
        }

        .alert-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 10px;
        }

        .alert-message {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
            line-height: 1.5;
        }

        .alert-btn {
            background: orangered;
            color: white;
            border: none;
            padding: 12px 32px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .alert-btn:hover {
            background: #ff4500;
            transform: translateY(-1px);
        }

        .alert-btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    @if(session('error'))
    <div class="alert-overlay" id="alertOverlay">
        <div class="alert-box">
            <div class="alert-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h3 class="alert-title">Access Denied</h3>
            <p class="alert-message">{{ session('error') }}</p>
            <button class="alert-btn" onclick="closeAlert()">OK</button>
        </div>
    </div>
    @endif

    <div class="container">
        <!-- Form Section -->
        <div class="form-section">
            <div class="logo">
                <img src="{{ asset('imgs/logo/logo.png') }}" alt="Sunny Auto Logo">
            </div>

            <div class="header-text">
                <small>Bắt đầu hành trình của bạn</small>
                <h1>Đăng nhập vào Sunny Auto</h1>
            </div>

            <div class="form-wrapper">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-wrapper">
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                placeholder="example@email.com" 
                                value="{{ old('email') }}" 
                                required
                            >
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </span>
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-wrapper">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••" 
                                required
                            >
                            <span class="input-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </span>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-login">Đăng Nhập</button>
                </form>

                <div class="divider">
                    <span>hoặc đăng nhập với</span>
                </div>

                <div class="social-buttons">
                    <button type="button" class="social-btn" title="Facebook">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#1877F2">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </button>
                    <button type="button" class="social-btn" title="Google">
                        <svg width="22" height="22" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </button>
                    <button type="button" class="social-btn" title="Apple">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="#000">
                            <path d="M17.05 20.28c-.98.95-2.05.88-3.08.4-1.09-.5-2.08-.48-3.24 0-1.44.62-2.2.44-3.06-.4C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.54 4.09l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/>
                        </svg>
                    </button>
                </div>

                <p class="footer-text">
                    Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a>
                </p>
            </div>
        </div>

        <!-- Image Section -->
        <div class="image-section">
        </div>
    </div>

    <script>
        function closeAlert() {
            const overlay = document.getElementById('alertOverlay');
            if (overlay) {
                overlay.style.animation = 'fadeOut 0.3s ease';
                setTimeout(() => {
                    overlay.remove();
                }, 300);
            }
        }

        // Auto close after 5 seconds
        @if(session('error'))
        setTimeout(() => {
            closeAlert();
        }, 5000);
        @endif
    </script>
</body>
</html>