@extends('layouts.app')

@section('title', 'Quản lý Liên hệ')

@section('content')
<style>
    .contact-page {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        min-height: calc(100vh - 80px);
        padding: 40px 0 60px;
    }
    
    .page-container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 0 24px;
    }
    
    .page-header {
        margin-bottom: 40px;
        text-align: center;
    }
    
    .page-title {
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(135deg, #1e293b, #475569);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin: 0 0 12px 0;
        letter-spacing: -0.5px;
    }
    
    .page-subtitle {
        color: #64748b;
        font-size: 16px;
        font-weight: 500;
        margin: 0;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .stats-section {
        margin-bottom: 48px;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 32px;
        margin-bottom: 20px;
    }
    
    .stats-card {
        background: white;
        border-radius: 20px;
        padding: 32px 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    
    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--card-color-start), var(--card-color-end));
    }
    
    .stats-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }
    
    .stats-card.blue {
        --card-color-start: #3b82f6;
        --card-color-end: #1d4ed8;
    }
    
    .stats-card.orange {
        --card-color-start: #ff4500;
        --card-color-end: #dc2626;
    }
    
    .stats-card.green {
        --card-color-start: #f97316;
        --card-color-end: #c2410c;
    }
    
    .stats-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }
    
    .stats-info {
        flex: 1;
    }
    
    .stats-label {
        color: #64748b;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .stats-number {
        font-size: 42px;
        font-weight: 800;
        background: linear-gradient(135deg, var(--card-color-start), var(--card-color-end));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1;
        margin-bottom: 8px;
    }
    
    .stats-description {
        color: #94a3b8;
        font-size: 12px;
        font-weight: 500;
        margin: 0;
    }
    
    .stats-icon {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--card-color-start), var(--card-color-end));
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        flex-shrink: 0;
    }

    /* Filter và Export Section */
    .filter-section {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 32px;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .filter-title {
        font-size: 20px;
        font-weight: 800;
        color: #1e293b;
        margin: 0;
    }

    .export-buttons {
        display: flex;
        gap: 12px;
    }

    .btn-export {
        background: linear-gradient(135deg, #f97316 0%, #c2410c 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(16, 185, 129, 0.3);
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-export:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        color: white;
        text-decoration: none;
    }

    .filter-form {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        align-items: end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .filter-label {
        font-size: 12px;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-input {
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        transition: all 0.2s ease;
        background: #f8fafc;
    }

    .filter-input:focus {
        outline: none;
        border-color: #f97316;
        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.1);
        background: white;
    }

    .btn-filter {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(249, 115, 22, 0.3);
        border: none;
        cursor: pointer;
        height: fit-content;
    }

    .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(249, 115, 22, 0.4);
    }

    .btn-reset {
        background: #64748b;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        height: fit-content;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-reset:hover {
        background: #475569;
        transform: translateY(-2px);
        color: white;
        text-decoration: none;
    }
    
    .table-section {
        margin-bottom: 40px;
    }
    
    .contact-table-wrapper {
        background: white;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    
    .table-header {
        background: linear-gradient(135deg, #ff4500 0%, #dc2626 100%);
        padding: 32px 40px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .table-title {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 8px 0;
        letter-spacing: -0.3px;
    }
    
    .table-subtitle {
        opacity: 0.9;
        font-size: 14px;
        font-weight: 500;
        margin: 0;
    }

    .table-info {
        flex: 1;
    }

    .record-count {
        background: rgba(255, 255, 255, 0.2);
        padding: 8px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
    }
    
    .contact-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .contact-table thead {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    
    .contact-table thead th {
        padding: 20px 16px;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
        text-align: left;
    }
    
    .contact-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .contact-table tbody tr:hover {
        background: linear-gradient(90deg, #fff7ed 0%, #ffedd5 100%);
        transform: scale(1.002);
        box-shadow: 0 4px 12px rgba(255, 69, 0, 0.08);
    }
    
    .contact-table tbody tr:last-child {
        border-bottom: none;
    }
    
    .contact-table tbody td {
        padding: 20px 16px;
        vertical-align: middle;
        border: none;
        font-size: 14px;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .status-new {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        color: white;
    }
    
    .status-in_progress {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }
    
    .status-resolved {
        background: linear-gradient(135deg, #f97316, #c2410c);
        color: white;
    }
    
    .customer-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .customer-name {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
        margin: 0;
    }

    .customer-email {
        color: #3b82f6;
        font-size: 12px;
        margin: 0;
        font-weight: 500;
    }

    .customer-phone {
        color: #f97316;
        font-size: 12px;
        margin: 0;
        font-weight: 500;
    }
    
    .subject-text {
        font-weight: 600;
        color: #1e293b;
        font-size: 14px;
        margin: 0;
        line-height: 1.4;
    }
    
    .message-text {
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
        max-width: 250px;
    }
    
    .datetime-text {
        font-size: 12px;
        color: #64748b;
        margin: 0;
        font-weight: 500;
    }
    
    .action-buttons {
        display: flex;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }
    
    .btn-view {
        background: linear-gradient(135deg, #ff4500, #dc2626);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(255, 69, 0, 0.3);
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 69, 0, 0.4);
        text-decoration: none;
        color: white;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        padding: 8px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
    }
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }
    
    .empty-state {
        padding: 80px 40px;
        text-align: center;
    }
    
    .empty-state-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 24px;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    }
    
    .empty-state-title {
        font-size: 20px;
        font-weight: 800;
        color: #475569;
        margin: 0 0 8px 0;
    }
    
    .empty-state-text {
        color: #94a3b8;
        font-size: 14px;
        margin: 0;
        font-weight: 500;
    }
    
    .pagination-wrapper {
        padding: 24px 32px;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }
    
    .pagination-content {
        display: flex;
        justify-content: center;
    }
    
    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .filter-form {
            grid-template-columns: 1fr;
        }

        .export-buttons {
            flex-direction: column;
        }
        
        .contact-table tbody td {
            padding: 16px 12px;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 4px;
        }

        .table-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }
    }
</style>

<div class="contact-page">
    <div class="page-container">
        <!-- Page Header -->
        <div class="page-header">
            <h1 class="page-title">💬 Quản lý Liên hệ</h1>
            <p class="page-subtitle">Theo dõi và quản lý các tin nhắn từ khách hàng một cách chuyên nghiệp</p>
        </div>

        <!-- Stats Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <!-- New Messages -->
                <div class="stats-card blue">
                    <div class="stats-content">
                        <div class="stats-info">
                            <p class="stats-label">Tin nhắn mới</p>
                            <div class="stats-number">{{ $newCount }}</div>
                            <p class="stats-description">Trong 24h qua</p>
                        </div>
                        <div class="stats-icon blue">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 32px; height: 32px; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Unread Messages -->
                <div class="stats-card orange">
                    <div class="stats-content">
                        <div class="stats-info">
                            <p class="stats-label">Chưa đọc</p>
                            <div class="stats-number">{{ $unreadCount }}</div>
                            <p class="stats-description">Cần xem ngay</p>
                        </div>
                        <div class="stats-icon orange">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 32px; height: 32px; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Contacts -->
                <div class="stats-card green">
                    <div class="stats-content">
                        <div class="stats-info">
                            <p class="stats-label">Tổng liên hệ</p>
                            <div class="stats-number">{{ $contacts->total() }}</div>
                            <p class="stats-description">Tất cả tin nhắn</p>
                        </div>
                        <div class="stats-icon green">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 32px; height: 32px; color: white;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-header">
                <h3 class="filter-title">🔍 Tìm kiếm và lọc dữ liệu</h3>
                <div class="export-buttons">
                    <form action="{{ route('contacts.export') }}" method="GET" style="display: inline;">
                        @foreach(request()->query() as $key => $value)
                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn-export">
                            📊 Export Excel
                        </button>
                    </form>
                </div>
            </div>
            
            <form method="GET" action="{{ route('contacts.index') }}" class="filter-form">
                <div class="filter-group">
                    <label class="filter-label">Tên khách hàng</label>
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="Nhập tên..." class="filter-input">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Email</label>
                    <input type="email" name="email" value="{{ request('email') }}" placeholder="Nhập email..." class="filter-input">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Số điện thoại</label>
                    <input type="text" name="phone" value="{{ request('phone') }}" placeholder="Nhập SĐT..." class="filter-input">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Chủ đề</label>
                    <input type="text" name="subject" value="{{ request('subject') }}" placeholder="Nhập chủ đề..." class="filter-input">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Khu vực (Tỉnh/Thành phố)</label>
                    <select name="location" class="filter-input">
                        <option value="">-- Tất cả khu vực --</option>
                        @foreach($locations as $loc)
                            <option value="{{ $loc }}" {{ request('location') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Trạng thái</label>
                    <select name="status" class="filter-input">
                        <option value="">Tất cả</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Mới</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Đã giải quyết</option>
                    </select>
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Từ ngày</label>
                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="filter-input">
                </div>
                
                <div class="filter-group">
                    <label class="filter-label">Đến ngày</label>
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="filter-input">
                </div>
                
                <div class="filter-group">
                    <button type="submit" class="btn-filter">🔍 Lọc</button>
                </div>
                
                <div class="filter-group">
                    <a href="{{ route('contacts.index') }}" class="btn-reset">↻ Reset</a>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="table-section">
            <div class="contact-table-wrapper">
                <div class="table-header">
                    <div class="table-info">
                        <h2 class="table-title">📋 Danh sách liên hệ</h2>
                        <p class="table-subtitle">Quản lý và trả lời các tin nhắn từ khách hàng</p>
                    </div>
                    <div class="record-count">
                        {{ $contacts->total() }} bản ghi
                    </div>
                </div>
                
                <table class="contact-table">
                    <thead>
                        <tr>
                            <th style="width: 8%;">Trạng thái</th>
                            <th style="width: 18%;">Thông tin khách hàng</th>
                            <th style="width: 16%;">Chủ đề</th>
                            <th style="width: 25%;">Nội dung tin nhắn</th>
                            <th style="width: 12%;">Thời gian gửi</th>
                            <th style="width: 8%;">Đã đọc</th>
                            <th style="width: 13%;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td style="text-align: center;">
                                    @if($contact->status == 'new')
                                        <span class="status-badge status-new">🔵 Mới</span>
                                    @elseif($contact->status == 'in_progress')
                                        <span class="status-badge status-in_progress">🟡 Đang xử lý</span>
                                    @else
                                        <span class="status-badge status-resolved">🟢 Đã giải quyết</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="customer-info">
                                        <p class="customer-name">👤 {{ $contact->name }}</p>
                                        <p class="customer-email">📧 {{ $contact->email }}</p>
                                        @if($contact->phone)
                                            <p class="customer-phone">📞 {{ $contact->phone }}</p>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <p class="subject-text">{{ $contact->subject }}</p>
                                </td>
                                <td>
                                    <p class="message-text">{{ Str::limit($contact->message, 100) }}</p>
                                </td>
                                <td>
                                    <p class="datetime-text">📅 {{ $contact->created_at->format('d/m/Y') }}</p>
                                    <p class="datetime-text">🕒 {{ $contact->created_at->format('H:i') }}</p>
                                </td>
                                <td style="text-align: center;">
                                    @if($contact->read_at)
                                        <span style="color: #f97316; font-size: 12px; font-weight: 600;">✅ Đã đọc</span>
                                        <p style="color: #64748b; font-size: 10px; margin: 4px 0 0 0;">{{ $contact->read_at->format('d/m H:i') }}</p>
                                    @else
                                        <span style="color: #f59e0b; font-size: 12px; font-weight: 600;">❌ Chưa đọc</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('contacts.show', $contact) }}" class="btn-view">
                                            👁️ Xem
                                        </a>
                                        <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" title="Xóa liên hệ">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state">
                                        <div class="empty-state-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 60px; height: 60px; color: #94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="empty-state-title">Không tìm thấy liên hệ nào</h3>
                                        <p class="empty-state-text">Hãy thử điều chỉnh bộ lọc hoặc kiểm tra lại từ khóa tìm kiếm</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                @if($contacts->hasPages())
                    <div class="pagination-wrapper">
                        <div class="pagination-content">
                            {{ $contacts->appends(request()->query())->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
// Auto-refresh unread count every 30 seconds
setInterval(async () => {
    try {
        const response = await fetch('/api/contacts/unread-count');
        const data = await response.json();
        
        // Update badge if exists
        const badge = document.querySelector('.unread-badge');
        if (badge && data.count > 0) {
            badge.textContent = data.count;
            badge.style.display = 'inline-block';
        } else if (badge && data.count === 0) {
            badge.style.display = 'none';
        }
        
        // Show notification if new contacts
        if (data.count > 0 && !document.querySelector('.notification-shown')) {
            console.log(`Bạn có ${data.count} tin nhắn mới`);
        }
    } catch (error) {
        console.error('Error fetching unread count:', error);
    }
}, 30000);
</script>
@endsection