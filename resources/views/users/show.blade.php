@extends('layouts.app')

@section('title', 'Chi tiết Tài khoản')

@section('content')
<style>
    .show-user-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
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

    .content-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 24px;
    }

    .main-content {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .card {
        background: white;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f3f4f6;
    }

    .card-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title svg {
        width: 24px;
        height: 24px;
        fill: #ff4500;
    }

    .user-profile {
        text-align: center;
        padding: 20px;
    }

    .profile-logo {
        display: inline-block;
        margin-bottom: 20px;
    }

    .profile-logo img {
        height: 60px;
        width: auto;
    }

    .user-avatar-large {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: #ff4500;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 48px;
        margin: 0 auto 20px;
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
    }

    .user-name-large {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
    }

    .user-email-large {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 16px;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .badge-admin {
        background: linear-gradient(135deg, #fef3c7, #fbbf24);
        color: #92400e;
    }

    .badge-user {
        background: linear-gradient(135deg, #dbeafe, #3b82f6);
        color: #1e3a8a;
    }

    .badge svg {
        width: 14px;
        height: 14px;
        fill: currentColor;
    }

    .info-grid {
        display: grid;
        gap: 20px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 16px;
        background: #f9fafb;
        border-radius: 10px;
        transition: background 0.2s ease;
    }

    .info-row:hover {
        background: #f3f4f6;
    }

    .info-label {
        font-weight: 600;
        color: #374151;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-label svg {
        width: 18px;
        height: 18px;
        fill: #6b7280;
    }

    .info-value {
        font-size: 14px;
        color: #1a1a1a;
        text-align: right;
    }

    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .action-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .action-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 16px;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .btn {
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
    }

    .btn svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    .btn-edit {
        background: linear-gradient(135deg, #f97316, #059669);
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-reset {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    }

    .btn-back {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-back:hover {
        background: #e5e7eb;
    }

    .alert {
        padding: 16px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 14px;
        font-weight: 500;
    }

    .alert svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
        flex-shrink: 0;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
    }

    .modal.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        border-radius: 16px;
        padding: 32px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid #f3f4f6;
    }

    .modal-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #fef3c7, #fbbf24);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-icon svg {
        width: 24px;
        height: 24px;
        fill: #92400e;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        flex: 1;
    }

    .modal-body {
        margin-bottom: 24px;
    }

    .form-group {
        margin-bottom: 16px;
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

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-input:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    .form-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }

    .modal-footer {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .btn-modal-cancel {
        background: #f3f4f6;
        color: #374151;
        padding: 12px 24px;
    }

    .btn-modal-confirm {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        padding: 12px 24px;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="show-user-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('users.index') }}">Quản lý Tài khoản</a>
        <span>/</span>
        <span>Chi tiết</span>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="content-grid">
        <!-- Main Content -->
        <div class="main-content">
            <!-- User Profile Card -->
            <div class="card">
                <div class="user-profile">
                    <div class="profile-logo">
                        <img src="{{ asset('imgs/logo/logo.png') }}" alt="Sunny Auto Logo">
                    </div>
                    <div class="user-avatar-large">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="user-name-large">{{ $user->name }}</div>
                    <div class="user-email-large">{{ $user->email }}</div>
                    @if($user->role === 'admin')
                        <span class="badge badge-admin">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                            </svg>
                            Quản trị viên
                        </span>
                    @else
                        <span class="badge badge-user">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            Người dùng
                        </span>
                    @endif
                </div>
            </div>

            <!-- Account Details Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                        </svg>
                        Thông tin tài khoản
                    </h3>
                </div>
                <div class="info-grid">
                    <div class="info-row">
                        <span class="info-label">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                            Họ và tên
                        </span>
                        <span class="info-value">{{ $user->name }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            Địa chỉ Email
                        </span>
                        <span class="info-value">{{ $user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                            </svg>
                            Vai trò
                        </span>
                        <span class="info-value">
                            @if($user->role === 'admin')
                                <span class="badge badge-admin" style="display: inline-flex;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                                    </svg>
                                    Admin
                                </span>
                            @else
                                <span class="badge badge-user" style="display: inline-flex;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                    </svg>
                                    User
                                </span>
                            @endif
                        </span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                            </svg>
                            Ngày tạo
                        </span>
                        <span class="info-value">{{ $user->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
                            </svg>
                            Cập nhật lần cuối
                        </span>
                        <span class="info-value">{{ $user->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Actions Card -->
            <div class="action-card">
                <h3 class="action-card-title">Thao tác</h3>
                <div class="action-buttons">
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-edit">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                        Chỉnh sửa tài khoản
                    </a>

                    <button type="button" onclick="openResetPasswordModal()" class="btn btn-reset">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                        </svg>
                        Đặt lại mật khẩu
                    </button>

                    <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này? Hành động này không thể hoàn tác!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                            </svg>
                            Xóa tài khoản
                        </button>
                    </form>

                    <a href="{{ route('users.index') }}" class="btn btn-back">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                        </svg>
                        Quay lại danh sách
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reset Password Modal -->
<div id="resetPasswordModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                </svg>
            </div>
            <h3 class="modal-title">Đặt lại mật khẩu</h3>
        </div>
        <form action="{{ route('users.reset-password', $user) }}" method="POST">
            @csrf
            <div class="modal-body">
                <p style="color: #6b7280; margin-bottom: 20px; font-size: 14px;">
                    Đặt mật khẩu mới cho tài khoản: <strong>{{ $user->name }}</strong>
                </p>
                
                <div class="form-group">
                    <label for="new_password" class="form-label">
                        Mật khẩu mới <span class="required">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        class="form-input" 
                        placeholder="••••••••"
                        required
                        minlength="8"
                    >
                    <p class="form-hint">Tối thiểu 8 ký tự</p>
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation" class="form-label">
                        Xác nhận mật khẩu <span class="required">*</span>
                    </label>
                    <input 
                        type="password" 
                        id="new_password_confirmation" 
                        name="new_password_confirmation" 
                        class="form-input" 
                        placeholder="••••••••"
                        required
                        minlength="8"
                    >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeResetPasswordModal()" class="btn btn-modal-cancel">
                    Hủy bỏ
                </button>
                <button type="submit" class="btn btn-modal-confirm">
                    Đặt lại mật khẩu
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openResetPasswordModal() {
        document.getElementById('resetPasswordModal').classList.add('active');
    }

    function closeResetPasswordModal() {
        document.getElementById('resetPasswordModal').classList.remove('active');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('resetPasswordModal');
        if (event.target === modal) {
            closeResetPasswordModal();
        }
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeResetPasswordModal();
        }
    });
</script>
@endsection
