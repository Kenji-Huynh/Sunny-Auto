@extends('layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('content')
<style>
    /* Products Index Page Styles */
    .products-container {
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
    .btn-add-product {
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

    .btn-add-product:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 69, 0, 0.4);
        background: linear-gradient(135deg, #ff6b35 0%, #ff4500 100%);
    }

    .btn-add-product svg {
        width: 18px;
        height: 18px;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-icon.orange {
        background: rgba(255, 69, 0, 0.1);
        color: #ff4500;
    }

    .stat-icon.blue {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .stat-icon.green {
        background: rgba(16, 185, 129, 0.1);
        color: #f97316;
    }

    .stat-icon.purple {
        background: rgba(139, 92, 246, 0.1);
        color: #8b5cf6;
    }

    .stat-icon svg {
        width: 24px;
        height: 24px;
    }

    .stat-info h3 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .stat-info p {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }

    /* Filter & Search Bar */
    .filter-bar {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 25px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-box {
        flex: 1;
        min-width: 250px;
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 10px 15px 10px 42px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .search-box input:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    .search-box svg {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #9ca3af;
    }

    .filter-select {
        padding: 10px 35px 10px 15px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        cursor: pointer;
        min-width: 150px;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%239ca3af'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 16px;
    }

    .filter-select:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    /* Products Table Container */
    .table-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        overflow: hidden;
    }

    .products-table {
        width: 100%;
        border-collapse: collapse;
    }

    .products-table thead {
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f4 100%);
    }

    .products-table th {
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #e5e7eb;
    }

    .products-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
    }

    .products-table tbody tr {
        transition: all 0.2s ease;
    }

    .products-table tbody tr:hover {
        background: #fffaf8;
    }

    .products-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Product Cell */
    .product-cell {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .product-image {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid #f0f0f0;
        transition: all 0.3s ease;
        background: white;
    }

    .product-image:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-color: #ff4500;
    }

    .product-image.placeholder-img {
        object-fit: contain;
        padding: 10px;
        background: #f9fafb;
    }

    .product-image-placeholder {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9ca3af;
        border: 2px dashed #d1d5db;
    }

    .product-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 4px 0;
    }

    .product-info p {
        font-size: 12px;
        color: #6b7280;
        margin: 0;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .status-badge.active {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .status-badge.inactive {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }

    .status-badge.draft {
        background: rgba(107, 114, 128, 0.1);
        color: #6b7280;
    }

    /* Category Badge */
    .category-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        background: rgba(255, 69, 0, 0.08);
        color: #ff4500;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 500;
    }

    /* Price Cell */
    .price-cell {
        font-weight: 600;
        color: #1a1a2e;
        font-size: 14px;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-action svg {
        width: 16px;
        height: 16px;
    }

    .btn-view {
        background: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }

    .btn-view:hover {
        background: #3b82f6;
        color: white;
    }

    .btn-edit {
        background: rgba(255, 69, 0, 0.1);
        color: #ff4500;
    }

    .btn-edit:hover {
        background: #ff4500;
        color: white;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-state svg {
        width: 80px;
        height: 80px;
        color: #d1d5db;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        font-size: 18px;
        font-weight: 600;
        color: #374151;
        margin: 0 0 8px 0;
    }

    .empty-state p {
        color: #6b7280;
        margin: 0 0 20px 0;
    }

    /* Pagination */
    .pagination-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 20px;
        border-top: 1px solid #f0f0f0;
        flex-wrap: wrap;
        gap: 15px;
    }

    .pagination-info {
        font-size: 14px;
        color: #6b7280;
    }

    .pagination-links {
        display: flex;
        gap: 5px;
    }

    .pagination-links a,
    .pagination-links span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 36px;
        height: 36px;
        padding: 0 12px;
        border-radius: 8px;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination-links a {
        background: #f3f4f6;
        color: #374151;
    }

    .pagination-links a:hover {
        background: #ff4500;
        color: white;
    }

    .pagination-links .active {
        background: #ff4500;
        color: white;
        font-weight: 600;
    }

    .pagination-links .disabled {
        background: #f9fafb;
        color: #d1d5db;
        cursor: not-allowed;
    }

    /* Alert Messages */
    .alert {
        padding: 16px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        color: #059669;
    }

    .alert-success svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .products-table {
            display: block;
            overflow-x: auto;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .filter-bar {
            flex-direction: column;
        }

        .search-box {
            width: 100%;
        }

        .filter-select {
            width: 100%;
        }

        .action-buttons {
            flex-wrap: wrap;
        }
    }
</style>

<div class="products-container">
    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header">
        <div class="page-header-left">
            <h2>Danh sách sản phẩm</h2>
            <p>Quản lý tất cả sản phẩm trong hệ thống</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn-add-product">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Thêm sản phẩm mới
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon orange">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $products->total() ?? count($products) }}</h3>
                <p>Tổng sản phẩm</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $products->where('status', 'active')->count() ?? 0 }}</h3>
                <p>Đang hoạt động</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $products->pluck('category_id')->unique()->count() ?? 0 }}</h3>
                <p>Danh mục</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <div class="stat-info">
                <h3>{{ $products->pluck('brand_id')->unique()->count() ?? 0 }}</h3>
                <p>Thương hiệu</p>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('products.index') }}" id="filterForm">
        <div class="filter-bar">
            <div class="search-box">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." id="searchInput" value="{{ request('search') }}">
            </div>
            <select class="filter-select" id="categoryFilter" name="category">
                <option value="">Tất cả danh mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <select class="filter-select" id="brandFilter" name="brand">
                <option value="">Tất cả thương hiệu</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Products Table -->
    <div class="table-container">
        @if($products->count() > 0)
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Giá</th>
                        <th>Trạng thái</th>
                        <th style="text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="product-cell">
                                    @if($product->primaryImage)
                                        <img src="{{ asset($product->primaryImage->url) }}" 
                                             alt="{{ $product->name }}" 
                                             class="product-image"
                                             onerror="this.onerror=null; this.src='/imgs/products/placeholder.svg'; this.classList.add('placeholder-img');">
                                    @elseif($product->media && $product->media->count() > 0)
                                        <img src="{{ asset($product->media->first()->url) }}" 
                                             alt="{{ $product->name }}" 
                                             class="product-image"
                                             onerror="this.onerror=null; this.src='/imgs/products/placeholder.svg'; this.classList.add('placeholder-img');">
                                    @else
                                        <div class="product-image-placeholder">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="30" height="30">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="product-info">
                                        <h4>{{ $product->name }}</h4>
                                        <p>SKU: {{ $product->sku ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($product->category)
                                    <span class="category-badge">{{ $product->category->name }}</span>
                                @else
                                    <span style="color: #9ca3af;">Chưa phân loại</span>
                                @endif
                            </td>
                            <td>
                                @if($product->brand)
                                    {{ $product->brand->name }}
                                @else
                                    <span style="color: #9ca3af;">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="price-cell">
                                    @if($product->msrp_price)
                                        {{ number_format($product->msrp_price, 0, ',', '.') }} {{ $product->currency ?? 'VND' }}
                                    @else
                                        <span style="color: #9ca3af;">Liên hệ</span>
                                    @endif
                                </span>
                            </td>
                            <td>
                                @php
                                    $statusClass = match($product->status ?? 'draft') {
                                        'active' => 'active',
                                        'inactive' => 'inactive',
                                        default => 'draft'
                                    };
                                    $statusText = match($product->status ?? 'draft') {
                                        'active' => 'Hoạt động',
                                        'inactive' => 'Ngừng bán',
                                        default => 'Nháp'
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                                <div class="action-buttons" style="justify-content: center;">
                                    <a href="{{ route('products.show', $product) }}" class="btn-action btn-view" title="Xem chi tiết">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.edit', $product) }}" class="btn-action btn-edit" title="Chỉnh sửa">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Xóa">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            @if(method_exists($products, 'links'))
                <div class="pagination-container">
                    <div class="pagination-info">
                        Hiển thị {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} 
                        trong tổng số {{ $products->total() ?? 0 }} sản phẩm
                    </div>
                    <div class="pagination-links">
                        {{ $products->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <h3>Chưa có sản phẩm nào</h3>
                <p>Bắt đầu bằng cách thêm sản phẩm đầu tiên của bạn</p>
                <a href="{{ route('products.create') }}" class="btn-add-product">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Thêm sản phẩm mới
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    // Auto-submit form when filters change
    const categoryFilter = document.getElementById('categoryFilter');
    const brandFilter = document.getElementById('brandFilter');
    const searchInput = document.getElementById('searchInput');
    const filterForm = document.getElementById('filterForm');

    // Submit form when category or brand changes
    categoryFilter?.addEventListener('change', function() {
        filterForm.submit();
    });

    brandFilter?.addEventListener('change', function() {
        filterForm.submit();
    });

    // Debounced search - submit after user stops typing
    let searchTimeout;
    searchInput?.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            filterForm.submit();
        }, 500); // Wait 500ms after user stops typing
    });
</script>
@endsection
