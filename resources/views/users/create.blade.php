@extends('layouts.app')

@section('title', 'Thêm Tài khoản Mới')

@section('content')
<style>
    .create-user-container {
        padding: 30px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-subtitle {
        font-size: 14px;
        color: #6b7280;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
        font-size: 14px;
    }

    .breadcrumb a {
        color: #ff4500;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .breadcrumb a:hover {
        color: #ff3500;
    }

    .breadcrumb span {
        color: #9ca3af;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
        margin-bottom: 24px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group.full-width {
        grid-column: span 2;
    }

    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-label .required {
        color: #ef4444;
    }

    .form-input,
    .form-select {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    .form-input.error,
    .form-select.error {
        border-color: #ef4444;
    }

    .form-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-hint svg {
        width: 14px;
        height: 14px;
        fill: currentColor;
        flex-shrink: 0;
    }

    .error-message {
        font-size: 13px;
        color: #ef4444;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .error-message svg {
        width: 14px;
        height: 14px;
        fill: currentColor;
        flex-shrink: 0;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 24px;
        border-top: 2px solid #f3f4f6;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-cancel {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-cancel:hover {
        background: #e5e7eb;
    }

    .btn-submit {
        background: linear-gradient(135deg, #ff4500, #ff6347);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 69, 0, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 69, 0, 0.4);
        background: linear-gradient(135deg, #ff3500, #ff5337);
    }

    .btn svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .info-box {
        background: linear-gradient(135deg, #fff7ed, #ffedd5);
        border-left: 4px solid #ff4500;
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 24px;
    }

    .info-box-title {
        font-weight: 600;
        color: #9a3412;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .info-box-title svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .info-box-content {
        font-size: 13px;
        color: #7c2d12;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full-width {
            grid-column: span 1;
        }

        .form-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="create-user-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('users.index') }}">Quản lý Tài khoản</a>
        <span>/</span>
        <span>Thêm mới</span>
    </div>

    <!-- Page Header -->
    <div class="page-header">
        <h1 class="page-title">Thêm Tài khoản Mới</h1>
        <p class="page-subtitle">Tạo tài khoản mới cho hệ thống</p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <div class="info-box-title">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
            </svg>
            Lưu ý quan trọng
        </div>
        <div class="info-box-content">
            • Tài khoản được tạo sẽ tự động có quyền <strong>Quản trị viên (Admin)</strong> với toàn quyền quản trị hệ thống<br>
            • Mật khẩu phải có ít nhất 8 ký tự và nên bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt<br>
            • Email phải là duy nhất trong hệ thống
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="form-label">
                        Họ và tên <span class="required">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        class="form-input @error('name') error @enderror" 
                        value="{{ old('name') }}" 
                        placeholder="Nhập họ và tên"
                        required
                    >
                    @error('name')
                        <span class="error-message">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        Email <span class="required">*</span>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        class="form-input @error('email') error @enderror" 
                        value="{{ old('email') }}" 
                        placeholder="example@domain.com"
                        required
                    >
                    @error('email')
                        <span class="error-message">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                    <span class="form-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Email sẽ được dùng để đăng nhập vào hệ thống
                    </span>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        Mật khẩu <span class="required">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') error @enderror" 
                        placeholder="••••••••"
                        required
                    >
                    @error('password')
                        <span class="error-message">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                            </svg>
                            {{ $message }}
                        </span>
                    @enderror
                    <span class="form-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Tối thiểu 8 ký tự, nên kết hợp chữ hoa, số và ký tự đặc biệt
                    </span>
                </div>

                <!-- Password Confirmation -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        Xác nhận mật khẩu <span class="required">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input" 
                        placeholder="••••••••"
                        required
                    >
                    <span class="form-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Nhập lại mật khẩu để xác nhận
                    </span>
                </div>

                <!-- Role Info (Read-only display) -->
                <div class="form-group full-width">
                    <label class="form-label">
                        Vai trò
                    </label>
                    <div style="
                        padding: 12px 16px;
                        background: linear-gradient(135deg, #f0fdf4, #dcfce7);
                        border: 2px solid #86efac;
                        border-radius: 10px;
                        display: flex;
                        align-items: center;
                        gap: 12px;
                        font-weight: 600;
                        color: #166534;
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <span>Quản trị viên (Admin) - Toàn quyền quản trị</span>
                    </div>
                    <span class="form-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Tất cả tài khoản tạo từ admin panel đều có quyền quản trị viên
                    </span>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('users.index') }}" class="btn btn-cancel">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                    </svg>
                    Hủy bỏ
                </a>
                <button type="submit" class="btn btn-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    Tạo tài khoản
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
