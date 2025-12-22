@extends('layouts.app')

@section('title', 'Quản lý Tài khoản')

@section('content')
<style>
    .users-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }


    .btn-add {
        background: linear-gradient(135deg, #ff4500, #ff6347);
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        box-shadow: 0 4px 15px rgba(255, 69, 0, 0.3);
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 69, 0, 0.4);
        background: linear-gradient(135deg, #ff3500, #ff5337);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .stat-icon.users {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .stat-icon.admins {
        background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .stat-icon.regular {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
    }

    .stat-icon.recent {
        background: linear-gradient(135deg, #43e97b, #38f9d7);
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
        fill: white;
    }

    .stat-label {
        font-size: 14px;
        color: #6b7280;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
    }

    .filters-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 24px;
    }

    .filters-row {
        display: flex;
        gap: 16px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 12px 16px 12px 44px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    .filter-select {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        min-width: 180px;
    }

    .filter-select:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    .users-table-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table thead {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }

    .users-table th {
        padding: 16px 20px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e5e7eb;
    }

    .users-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f3f4f6;
        vertical-align: middle;
    }

    .users-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .users-table tbody tr:hover {
        background-color: #fafafa;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }


    .user-details {
        flex: 1;
    }

    .user-name {
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 4px;
    }

    .user-email {
        font-size: 13px;
        color: #6b7280;
    }

    .badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
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
        width: 12px;
        height: 12px;
        fill: currentColor;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        background: white;
    }

    .btn-action svg {
        width: 18px;
        height: 18px;
    }

    .btn-view {
        color: #3b82f6;
        border: 2px solid #dbeafe;
    }

    .btn-view:hover {
        background: #dbeafe;
        border-color: #3b82f6;
    }

    .btn-edit {
        color: #10b981;
        border: 2px solid #d1fae5;
    }

    .btn-edit:hover {
        background: #d1fae5;
        border-color: #10b981;
    }

    .btn-delete {
        color: #ef4444;
        border: 2px solid #fee2e2;
    }

    .btn-delete:hover {
        background: #fee2e2;
        border-color: #ef4444;
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

    .pagination {
        padding: 24px;
        display: flex;
        justify-content: center;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        opacity: 0.4;
    }

    .empty-state h3 {
        color: #6b7280;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #9ca3af;
        font-size: 14px;
    }
</style>

<div class="users-container">
    <!-- Action Button -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 20px;">
        <a href="{{ route('users.create') }}" class="btn-add">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5 11h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
            </svg>
            Thêm Tài khoản
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon users">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                </svg>
            </div>
            <div class="stat-label">Tổng Tài khoản</div>
            <div class="stat-value">{{ $users->total() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon admins">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                </svg>
            </div>
            <div class="stat-label">Tài khoản Admin</div>
            <div class="stat-value">{{ $adminCount }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon recent">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z"/>
                </svg>
            </div>
            <div class="stat-label">Mới tháng này</div>
            <div class="stat-value">{{ $recentCount }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon regular">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="stat-label">Tài khoản hoạt động</div>
            <div class="stat-value">{{ $adminCount }}</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <form action="{{ route('users.index') }}" method="GET">
            <div class="filters-row">
                <div class="search-box">
                    <span class="search-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="currentColor">
                            <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                        </svg>
                    </span>
                    <input type="text" name="search" placeholder="Tìm kiếm theo tên hoặc email..." value="{{ request('search') }}">
                </div>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="users-table-card">
        <div class="table-responsive">
            @if($users->count() > 0)
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Tài khoản</th>
                            <th>Vai trò</th>
                            <th>Ngày tạo</th>
                            <th style="text-align: center;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div class="user-details">
                                            <div class="user-name">{{ $user->name }}</div>
                                            <div class="user-email">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-admin">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z"/>
                                        </svg>
                                        Admin
                                    </span>
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="action-buttons" style="justify-content: center;">
                                        <a href="{{ route('users.show', $user) }}" class="btn-action btn-view" title="Xem chi tiết">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('users.edit', $user) }}" class="btn-action btn-edit" title="Chỉnh sửa">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Xóa">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                    </svg>
                    <h3>Không tìm thấy tài khoản</h3>
                    <p>Không có tài khoản nào phù hợp với tiêu chí tìm kiếm của bạn</p>
                </div>
            @endif
        </div>

        @if($users->hasPages())
            <div class="pagination">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
