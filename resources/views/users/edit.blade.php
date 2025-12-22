@extends('layouts.app')

@section('title', 'Chỉnh sửa Tài khoản')

@section('content')
<style>
    .edit-user-container {
        padding: 30px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 8px 0;
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

    .warning-box {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border-left: 4px solid #f59e0b;
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 24px;
    }

    .warning-box-title {
        font-weight: 600;
        color: #92400e;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
    }

    .warning-box-title svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .warning-box-content {
        font-size: 13px;
        color: #78350f;
        line-height: 1.6;
    }

    .info-box {
        background: linear-gradient(135deg, #dbeafe, #bfdbfe);
        border-left: 4px solid #3b82f6;
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 24px;
    }

    .info-box-title {
        font-weight: 600;
        color: #1e40af;
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
        color: #1e3a8a;
        line-height: 1.6;
    }

    .user-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 16px;
    }

    .user-badge.admin {
        background: linear-gradient(135deg, #fef3c7, #fbbf24);
        color: #92400e;
    }

    .user-badge.user {
        background: linear-gradient(135deg, #dbeafe, #3b82f6);
        color: #1e3a8a;
    }

    .user-badge svg {
        width: 16px;
        height: 16px;
        fill: currentColor;
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

<div class="edit-user-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('users.index') }}">Quản lý Tài khoản</a>
        <span>/</span>
        <span>Chỉnh sửa: {{ $user->name }}</span>
    </div>

    <!-- Current Role Badge -->
    <div>
        @if($user->role === 'admin')
            <span class="user-badge admin">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                </svg>
                Quản trị viên
            </span>
        @else
            <span class="user-badge user">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
                Người dùng
            </span>
        @endif
    </div>

    <!-- Warning Box for Role Change -->
    @if($user->role === 'admin')
        <div class="warning-box">
            <div class="warning-box-title">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M1 21h22L12 2 1 21zm12-3h-2v-2h2v2zm0-4h-2v-4h2v4z"/>
                </svg>
                Cảnh báo khi thay đổi vai trò Admin
            </div>
            <div class="warning-box-content">
                • Tài khoản này hiện đang có quyền Quản trị viên<br>
                • Thay đổi vai trò sẽ ảnh hưởng đến quyền truy cập hệ thống<br>
                • Đảm bảo luôn có ít nhất một tài khoản Admin hoạt động
            </div>
        </div>
    @endif

    <!-- Info Box for Password -->
    <div class="info-box">
        <div class="info-box-title">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
            </svg>
            Thay đổi mật khẩu (Tùy chọn)
        </div>
        <div class="info-box-content">
            • Để trống trường mật khẩu nếu không muốn thay đổi<br>
            • Nếu nhập mật khẩu mới, cần nhập xác nhận mật khẩu<br>
            • Mật khẩu mới phải có ít nhất 8 ký tự
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

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
                        value="{{ old('name', $user->name) }}" 
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
                        value="{{ old('email', $user->email) }}" 
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
                        Email hiện tại: {{ $user->email }}
                    </span>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        Mật khẩu mới
                    </label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-input @error('password') error @enderror" 
                        placeholder="••••••••"
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
                        Để trống nếu không muốn thay đổi mật khẩu
                    </span>
                </div>

                <!-- Password Confirmation -->
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        Xác nhận mật khẩu mới
                    </label>
                    <input 
                        type="password" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        class="form-input" 
                        placeholder="••••••••"
                    >
                    <span class="form-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Chỉ cần nhập nếu bạn đã nhập mật khẩu mới
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
                    Cập nhật
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
