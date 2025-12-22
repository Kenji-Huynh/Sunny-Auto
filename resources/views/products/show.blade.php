@extends('layouts.app')

@section('title', $product->name)

@section('content')
<style>
    /* Detail Page Styles */
    .detail-container {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Page Header */
    .detail-header {
        background: white;
        border-radius: 12px;
        padding: 25px 30px;
        margin-bottom: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .detail-header-left h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0 0 8px 0;
    }

    .detail-header-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 13px;
        color: #6b7280;
    }

    .meta-item svg {
        width: 16px;
        height: 16px;
    }

    .detail-header-actions {
        display: flex;
        gap: 10px;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        gap: 5px;
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

    .status-badge svg {
        width: 14px;
        height: 14px;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, #ff4500 0%, #ff6b35 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(255, 69, 0, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 69, 0, 0.4);
    }

    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #e5e7eb;
    }

    .btn-danger {
        background: #ef4444;
        color: white;
    }

    .btn-danger:hover {
        background: #dc2626;
    }

    .btn svg {
        width: 18px;
        height: 18px;
    }

    /* Grid Layout */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 30px;
        margin-bottom: 30px;
    }

    @media (max-width: 1024px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Card */
    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        margin-bottom: 25px;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 20px 0;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-title svg {
        width: 20px;
        height: 20px;
        color: #ff4500;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .info-label {
        font-size: 13px;
        font-weight: 500;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 15px;
        color: #1a1a2e;
        font-weight: 500;
    }

    .info-value.price {
        font-size: 20px;
        color: #ff4500;
        font-weight: 700;
    }

    .info-value.empty {
        color: #9ca3af;
        font-style: italic;
    }

    /* Description */
    .description-text {
        color: #374151;
        line-height: 1.8;
        white-space: pre-line;
    }

    /* Image Gallery */
    .image-gallery {
        display: grid;
        gap: 15px;
    }

    .gallery-image {
        width: 100%;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .gallery-image img {
        width: 100%;
        display: block;
        transition: transform 0.3s ease;
    }

    .gallery-image:hover img {
        transform: scale(1.05);
    }

    .gallery-image.primary {
        border: 3px solid #ff4500;
    }

    .primary-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #ff4500;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .no-image {
        text-align: center;
        padding: 60px 20px;
        background: linear-gradient(135deg, #f0f0f0 0%, #e5e5e5 100%);
        border-radius: 10px;
    }

    .no-image svg {
        width: 60px;
        height: 60px;
        color: #9ca3af;
        margin-bottom: 15px;
    }

    .no-image p {
        color: #6b7280;
        margin: 0;
    }

    /* Alert */
    .alert {
        padding: 16px 20px;
        border-radius: 10px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .alert-warning {
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.2);
        color: #d97706;
    }

    .alert svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }

    /* Specs Grid */
    .specs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    .spec-card {
        background: #f9fafb;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    .spec-card .info-label {
        font-size: 12px;
    }

    .spec-card .info-value {
        font-size: 16px;
        margin-top: 5px;
    }
</style>

<div class="detail-container">
    <!-- Page Header -->
    <div class="detail-header">
        <div class="detail-header-left">
            <h1>{{ $product->name }}</h1>
            <div class="detail-header-meta">
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
                <span class="status-badge {{ $statusClass }}">
                    @if($statusClass === 'active')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @elseif($statusClass === 'inactive')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    @endif
                    {{ $statusText }}
                </span>
                @if($product->sku)
                    <span class="meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        SKU: {{ $product->sku }}
                    </span>
                @endif
                <span class="meta-item">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $product->updated_at->format('d/m/Y H:i') }}
                </span>
            </div>
        </div>
        <div class="detail-header-actions">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Chỉnh sửa
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Quay lại
            </a>
        </div>
    </div>

    <div class="detail-grid">
        <!-- Main Content -->
        <div>
            <!-- Thông tin cơ bản -->
            <div class="detail-card">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Thông tin cơ bản
                </h2>
                <div class="info-grid">
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Giá bán</span>
                        <span class="info-value price">
                            @if($product->msrp_price)
                                {{ number_format($product->msrp_price, 0, ',', '.') }} {{ $product->currency ?? 'VND' }}
                            @else
                                <span class="info-value empty">Liên hệ</span>
                            @endif
                        </span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Thương hiệu</span>
                        <span class="info-value">{{ $product->brand->name ?? '—' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Danh mục</span>
                        <span class="info-value">{{ $product->category->name ?? '—' }}</span>
                    </div>
                    @if($product->release_date)
                        <div class="info-item">
                            <span class="info-label">Ngày phát hành</span>
                            <span class="info-value">{{ \Carbon\Carbon::parse($product->release_date)->format('d/m/Y') }}</span>
                        </div>
                    @endif
                    @if($product->warranty_years || $product->warranty_km)
                        <div class="info-item">
                            <span class="info-label">Bảo hành</span>
                            <span class="info-value">
                                @if($product->warranty_years) {{ $product->warranty_years }} năm @endif
                                @if($product->warranty_years && $product->warranty_km) / @endif
                                @if($product->warranty_km) {{ number_format($product->warranty_km) }} km @endif
                            </span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Mô tả -->
            @if($product->short_description || $product->description)
                <div class="detail-card">
                    <h2 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Mô tả sản phẩm
                    </h2>
                    @if($product->short_description)
                        <div style="margin-bottom: 20px;">
                            <span class="info-label">Mô tả ngắn</span>
                            <p class="description-text" style="margin-top: 10px;">{{ $product->short_description }}</p>
                        </div>
                    @endif
                    @if($product->description)
                        <div>
                            <span class="info-label">Mô tả chi tiết</span>
                            <div class="description-text" style="margin-top: 10px;">{{ $product->description }}</div>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Thông số kỹ thuật điện -->
            @if($product->evcSpec)
                <div class="detail-card">
                    <h2 class="card-title">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Thông số kỹ thuật điện
                    </h2>
                    <div class="specs-grid">
                        @if($product->evcSpec->battery_capacity_kwh)
                            <div class="spec-card">
                                <span class="info-label">Dung lượng pin</span>
                                <div class="info-value">
                                    {{ $product->evcSpec->battery_capacity_kwh }} kWh
                                    @if($product->evcSpec->battery_type)
                                        {{ $product->evcSpec->battery_type }}
                                    @endif
                                    @if($product->evcSpec->battery_supplier)
                                        ({{ $product->evcSpec->battery_supplier }})
                                    @endif
                                </div>
                            </div>
                        @endif
                        @if($product->evcSpec->range_km)
                            <div class="spec-card">
                                <span class="info-label">Phạm vi hoạt động</span>
                                <div class="info-value">
                                    {{ $product->evcSpec->range_km }}
                                    @if($product->evcSpec->range_test_standard)
                                        ({{ $product->evcSpec->range_test_standard }})
                                    @endif
                                    km
                                </div>
                            </div>
                        @endif
                        @if($product->evcSpec->power_kw)
                            <div class="spec-card">
                                <span class="info-label">Công suất động cơ</span>
                                <div class="info-value">{{ $product->evcSpec->power_kw }} kW</div>
                            </div>
                        @endif
                        @if($product->evcSpec->torque_nm)
                            <div class="spec-card">
                                <span class="info-label">Mô-men xoắn</span>
                                <div class="info-value">{{ $product->evcSpec->torque_nm }} Nm</div>
                            </div>
                        @endif
                        @if($product->evcSpec->charge_10_80_min)
                            <div class="spec-card">
                                <span class="info-label">Thời gian sạc nhanh (10-80%)</span>
                                <div class="info-value">{{ $product->evcSpec->charge_10_80_min }} phút</div>
                            </div>
                        @endif
                        @if($product->evcSpec->onboard_charger_kw)
                            <div class="spec-card">
                                <span class="info-label">Bộ sạc tích hợp</span>
                                <div class="info-value">{{ $product->evcSpec->onboard_charger_kw }} kW</div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Hình ảnh -->
            <div class="detail-card">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Hình ảnh
                </h2>
                @if($product->media && $product->media->count() > 0)
                    <div class="image-gallery">
                        @foreach($product->media as $media)
                            <div class="gallery-image {{ $media->is_primary ? 'primary' : '' }}">
                                @if($media->is_primary)
                                    <span class="primary-badge">Ảnh chính</span>
                                @endif
                                <img src="{{ $media->url }}" alt="{{ $product->name }}">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-image">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p>Chưa có hình ảnh</p>
                    </div>
                @endif
            </div>

            <!-- Thao tác -->
            <div class="detail-card">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                    </svg>
                    Thao tác
                </h2>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary" style="justify-content: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Chỉnh sửa
                    </a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 100%; justify-content: center;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Xóa sản phẩm
                        </button>
                    </form>
                </div>
            </div>

            <!-- Thông tin khác -->
            <div class="detail-card">
                <h2 class="card-title">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Thông tin khác
                </h2>
                <div style="display: flex; flex-direction: column; gap: 15px;">
                    <div class="info-item">
                        <span class="info-label">Ngày tạo</span>
                        <span class="info-value">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Cập nhật lần cuối</span>
                        <span class="info-value">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                    </div>
                    @if($product->slug)
                        <div class="info-item">
                            <span class="info-label">Slug</span>
                            <span class="info-value">{{ $product->slug }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
