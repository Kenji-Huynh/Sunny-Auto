@extends('layouts.app')

@section('title', 'Quản lý Blog')

@section('content')
<style>
    /* Blog Index Page Styles */
    .blogs-container {
        padding: 0;
    }

    /* Page Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .page-header-left h2 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0 0 5px 0;
    }

    .page-header-left p {
        color: #6b7280;
        margin: 0;
        font-size: 14px;
    }

    /* Add Button */
    .btn-add-blog {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #ff4500 0%, #ff6b35 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 69, 0, 0.3);
    }

    .btn-add-blog:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 69, 0, 0.4);
        color: white;
    }

    /* Filter Section */
    .filter-section {
        background: white;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .filter-row {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 14px;
    }

    .filter-group input,
    .filter-group select {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
    }

    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    .btn-filter {
        padding: 10px 20px;
        background: #ff4500;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-filter:hover {
        background: #ff6b35;
        transform: translateY(-1px);
    }

    .btn-reset {
        padding: 10px 20px;
        background: #6b7280;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-reset:hover {
        background: #4b5563;
    }

    /* Blog Table */
    .blog-table-container {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .blog-table {
        width: 100%;
        border-collapse: collapse;
    }

    .blog-table thead {
        background: linear-gradient(135deg, #1a1a2e 0%, #2d3748 100%);
    }

    .blog-table thead th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        color: white;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .blog-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: all 0.2s;
    }

    .blog-table tbody tr:hover {
        background-color: #f9fafb;
    }

    .blog-table tbody td {
        padding: 16px;
        color: #374151;
        font-size: 14px;
    }

    /* Blog Image */
    .blog-image {
        width: 80px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .status-published {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-draft {
        background-color: #fef3c7;
        color: #92400e;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-view {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .btn-view:hover {
        background-color: #bfdbfe;
    }

    .btn-edit {
        background-color: #fef3c7;
        color: #92400e;
    }

    .btn-edit:hover {
        background-color: #fde68a;
    }

    .btn-delete {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .btn-delete:hover {
        background-color: #fecaca;
    }

    /* Pagination */
    .pagination-container {
        padding: 20px;
        display: flex;
        justify-content: center;
    }

    /* Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        animation: slideDown 0.3s ease;
    }

    .alert-success {
        background-color: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6b7280;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        opacity: 0.3;
    }

    .empty-state h3 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #374151;
    }

    .empty-state p {
        margin-bottom: 20px;
    }
</style>

<div class="blogs-container">
    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2>Quản lý Blog</h2>
            <p>Quản lý tất cả bài viết blog của website</p>
        </div>
        <a href="{{ route('blogs.create') }}" class="btn-add-blog">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Thêm bài viết mới
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Filter Section -->
    <div class="filter-section">
        <form action="{{ route('blogs.index') }}" method="GET">
            <div class="filter-row">
                <div class="filter-group">
                    <label>Tìm kiếm</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm theo tiêu đề...">
                </div>
                <div class="filter-group">
                    <label>Danh mục</label>
                    <select name="category_id">
                        <option value="">Tất cả danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label>Trạng thái</label>
                    <select name="status">
                        <option value="">Tất cả trạng thái</option>
                        <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                        <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Sắp xếp</label>
                    <select name="sort_by">
                        <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Ngày tạo</option>
                        <option value="published_at" {{ request('sort_by') == 'published_at' ? 'selected' : '' }}>Ngày xuất bản</option>
                        <option value="views_count" {{ request('sort_by') == 'views_count' ? 'selected' : '' }}>Lượt xem</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn-filter">Lọc</button>
                    <a href="{{ route('blogs.index') }}" class="btn-reset">Đặt lại</a>
                </div>
            </div>
        </form>
    </div>

    <!-- Blog Table -->
    <div class="blog-table-container">
        @if($posts->count() > 0)
            <table class="blog-table">
                <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Tác giả</th>
                        <th>Trạng thái</th>
                        <th>Lượt xem</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                                @if($post->featured_image)
                                    <img src="{{ asset($post->featured_image) }}" alt="{{ $post->title }}" class="blog-image">
                                @else
                                    <div style="width: 80px; height: 50px; background: #e5e7eb; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                            <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                            <polyline points="21 15 16 10 5 21"></polyline>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ Str::limit($post->title, 50) }}</strong>
                                @if($post->excerpt)
                                    <br><small style="color: #6b7280;">{{ Str::limit($post->excerpt, 60) }}</small>
                                @endif
                            </td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->author->name }}</td>
                            <td>
                                <span class="status-badge status-{{ $post->status }}">
                                    {{ $post->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                                </span>
                            </td>
                            <td>{{ number_format($post->views_count) }}</td>
                            <td>{{ $post->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('blogs.show', $post) }}" class="btn-action btn-view">Xem</a>
                                    <a href="{{ route('blogs.edit', $post) }}" class="btn-action btn-edit">Sửa</a>
                                    <form action="{{ route('blogs.destroy', $post) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">Xóa</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination-container">
                {{ $posts->links() }}
            </div>
        @else
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                    <path d="M3 9h18"/>
                    <path d="M9 21V9"/>
                </svg>
                <h3>Chưa có bài viết nào</h3>
                <p>Bắt đầu bằng cách thêm bài viết đầu tiên của bạn</p>
                <a href="{{ route('blogs.create') }}" class="btn-add-blog">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Thêm bài viết mới
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
