<!-- filepath: d:\Website Sunny Oto\laravel\resources\views\auth\register.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký - Sunny Auto Admin</title>
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
            padding: 60px 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-height: 95vh;
            overflow-y: auto;
            max-width: 560px;
            margin: 0 auto;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        .form-section::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 60px;
        }

        .logo img {
            height: 50px;
            width: auto;
        }

        .header-text {
            margin-bottom: 12px;
        }

        .header-text small {
            color: #666;
            font-size: 14px;
            font-weight: 400;
        }

        .header-text h1 {
            color: #1a1a1a;
            font-size: 28px;
            font-weight: 600;
            margin-top: 4px;
        }

        .form-wrapper {
            margin-top: 36px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            color: #4a5568;
            font-size: 13px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"] {
            width: 100%;
            max-width: 400px;
            padding: 11px 40px 11px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            color: #1a1a1a;
            transition: all 0.2s ease;
        }

        input::placeholder {
            color: #a0aec0;
        }

        input:focus {
            outline: none;
            border-color: orangered;
            box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
        }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            font-size: 16px;
            pointer-events: none;
        }

        .error-message {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 4px;
        }

        .btn-register {
            width: 100%;
            padding: 14px;
            background: orangered;
            color: white;
            border: 2px solid orangered;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 16px;
        }

        .btn-register:hover {
            background: white;
            color: orangered;
            border-color: orangered;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 69, 0, 0.2);
        }

        .footer-text {
            text-align: left;
            color: #718096;
            font-size: 14px;
            margin-top: 24px;
        }

        .footer-text a {
            color: orangered;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .image-section {
            background: url('{{ asset('imgs/unnamed (1).jpg') }}') center/cover no-repeat;
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
                margin-bottom: 40px;
            }

            .logo img {
                height: 38px;
            }

            .header-text {
                margin-bottom: 24px;
            }

            .header-text h1 {
                font-size: 26px;
            }

            .form-group {
                margin-bottom: 18px;
            }

            input[type="email"],
            input[type="password"],
            input[type="text"] {
                padding: 10px 40px 10px 14px;
                font-size: 16px;
                max-width: 100%;
            }

            .btn-register {
                padding: 13px;
                font-size: 16px;
                margin-top: 12px;
            }

            .footer-text {
                margin-top: 20px;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 24px 20px;
                max-height: none;
                overflow-y: visible;
            }

            .logo {
                margin-bottom: 32px;
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

            .form-group {
                margin-bottom: 16px;
            }

            .form-group label {
                font-size: 12px;
            }

            input[type="email"],
            input[type="password"],
            input[type="text"] {
                padding: 10px 38px 10px 12px;
                font-size: 16px;
            }

            .input-icon {
                font-size: 14px;
                right: 12px;
            }

            .btn-register {
                padding: 12px;
                font-size: 15px;
            }

            .footer-text {
                font-size: 13px;
                margin-top: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="logo">
                <img src="{{ asset('imgs/logo/logo.png') }}" alt="Sunny Auto Logo">
            </div>

            <div class="header-text">
                <small>Bắt đầu hành trình của bạn</small>
                <h1>Đăng ký tài khoản mới</h1>
            </div>

            <div class="form-wrapper">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Tên đầy đủ</label>
                        <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" 
                               value="{{ old('name') }}" required>
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" placeholder="example@email.com" 
                                   value="{{ old('email') }}" required>
                            <span class="input-icon">✉</span>
                        </div>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" placeholder="••••••••" required>
                            <span class="input-icon">👁</span>
                        </div>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Xác nhận mật khẩu</label>
                        <div class="input-wrapper">
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                   placeholder="••••••••" required>
                            <span class="input-icon">👁</span>
                        </div>
                    </div>

                    <button type="submit" class="btn-register">Đăng Ký</button>
                </form>

                <p class="footer-text">
                    Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
                </p>
            </div>
        </div>

        <div class="image-section">
        </div>
    </div>
</body>
</html>