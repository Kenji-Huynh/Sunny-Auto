@extends('layouts.app')
@section('title', 'Chi tiết liên hệ')

@section('content')
<style>
    .contact-detail { padding: 24px; }
    .back-link { color: #64748b; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 20px; }
    .back-link:hover { color: #1e40af; }
    .detail-card { background: #fff; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); margin-bottom: 20px; }
    .detail-header { padding: 20px 24px; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; }
    .detail-header h1 { font-size: 20px; font-weight: 600; color: #1e293b; margin: 0; }
    .detail-header .time { font-size: 13px; color: #94a3b8; margin-top: 4px; }
    .status-badge { padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
    .status-new { background: #dbeafe; color: #1d4ed8; }
    .status-processing { background: #fef3c7; color: #b45309; }
    .status-completed { background: #dcfce7; color: #15803d; }
    .detail-body { padding: 24px; }
    .section-title { font-size: 16px; font-weight: 600; color: #1e293b; margin: 0 0 16px 0; padding-bottom: 8px; border-bottom: 2px solid #e5e7eb; }
    .info-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; margin-bottom: 24px; }
    .info-box { background: #f8fafc; border-radius: 8px; padding: 16px; }
    .info-box label { display: block; font-size: 12px; color: #64748b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
    .info-box span { font-size: 15px; color: #1e293b; font-weight: 500; }
    .info-box a { color: #2563eb; text-decoration: none; font-weight: 500; }
    .info-box a:hover { text-decoration: underline; }
    .tag-list { display: flex; flex-wrap: wrap; gap: 8px; }
    .tag { background: #e0f2fe; color: #0369a1; padding: 4px 12px; border-radius: 16px; font-size: 13px; font-weight: 500; }
    .notes-box { background: #f8fafc; border-radius: 8px; padding: 16px; color: #334155; line-height: 1.6; white-space: pre-wrap; margin-bottom: 24px; }
    .action-row { display: flex; gap: 12px; flex-wrap: wrap; padding-top: 20px; border-top: 1px solid #f1f5f9; }
    .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer; transition: all 0.2s; }
    .btn-primary { background: #2563eb; color: #fff; }
    .btn-primary:hover { background: #1d4ed8; }
    .btn-success { background: #16a34a; color: #fff; }
    .btn-success:hover { background: #15803d; }
    .btn-danger { background: #fff; color: #dc2626; border: 1px solid #fecaca; }
    .btn-danger:hover { background: #fef2f2; }
    .update-section { background: #fff; border-radius: 12px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); padding: 24px; }
    .update-section h2 { font-size: 16px; font-weight: 600; color: #1e293b; margin: 0 0 20px 0; }
    .form-group { margin-bottom: 16px; }
    .form-group label { display: block; font-size: 13px; font-weight: 500; color: #475569; margin-bottom: 6px; }
    .form-control { width: 100%; padding: 10px 14px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; color: #1e293b; transition: border-color 0.2s; }
    .form-control:focus { outline: none; border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
    textarea.form-control { resize: vertical; min-height: 100px; }
    .current-note { background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 12px 16px; margin-top: 16px; font-size: 14px; color: #92400e; }
    @media (max-width: 768px) { .info-grid { grid-template-columns: 1fr; } .action-row { flex-direction: column; } .btn { justify-content: center; } }
</style>

<div class="contact-detail">
    <a href="{{ route('contacts.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Quay lại danh sách
    </a>

    <div class="detail-card">
        <div class="detail-header">
            <div>
                <h1>Liên hệ từ {{ $contact->name }}</h1>
                <div class="time"><i class="far fa-clock"></i> {{ $contact->created_at->format('H:i - d/m/Y') }}</div>
            </div>
            <span class="status-badge status-{{ $contact->status === 'new' ? 'new' : ($contact->status === 'processing' ? 'processing' : 'completed') }}">
                {{ $contact->status === 'new' ? 'Mới' : ($contact->status === 'processing' ? 'Đang xử lý' : 'Đã giải quyết') }}
            </span>
        </div>

        <div class="detail-body">
            <!-- Contact Information -->
            <h2 class="section-title">Thông tin liên hệ</h2>
            <div class="info-grid">
                <div class="info-box">
                    <label>Họ và tên</label>
                    <span>{{ $contact->name }}</span>
                </div>
                @if($contact->company)
                <div class="info-box">
                    <label>Công ty</label>
                    <span>{{ $contact->company }}</span>
                </div>
                @endif
                <div class="info-box">
                    <label>Email</label>
                    <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                </div>
                <div class="info-box">
                    <label>Số điện thoại</label>
                    <a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                </div>
                @if($contact->location)
                <div class="info-box">
                    <label>Tỉnh/Thành phố</label>
                    <span>{{ $contact->location }}</span>
                </div>
                @endif
            </div>

            <!-- Inquiry Types -->
            @if($contact->inquiry_types && count($contact->inquiry_types) > 0)
            <h2 class="section-title">Loại yêu cầu</h2>
            <div class="tag-list" style="margin-bottom: 24px;">
                @foreach($contact->inquiry_types as $type)
                    <span class="tag">{{ $type }}</span>
                @endforeach
            </div>
            @endif

            <!-- Products of Interest -->
            @if(($contact->ev_products && count($contact->ev_products) > 0) || ($contact->charging_products && count($contact->charging_products) > 0))
            <h2 class="section-title">Sản phẩm quan tâm</h2>
            <div style="margin-bottom: 24px;">
                @if($contact->ev_products && count($contact->ev_products) > 0)
                <div style="margin-bottom: 12px;">
                    <div style="font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 8px;">Xe điện:</div>
                    <div class="tag-list">
                        @foreach($contact->ev_products as $product)
                            <span class="tag" style="background: #dbeafe;">{{ $product }}</span>
                        @endforeach
                    </div>
                    @if($contact->ev_products_other)
                        <div style="margin-top: 8px; font-size: 13px; color: #64748b;">Khác: {{ $contact->ev_products_other }}</div>
                    @endif
                </div>
                @endif

                @if($contact->charging_products && count($contact->charging_products) > 0)
                <div>
                    <div style="font-size: 14px; font-weight: 600; color: #475569; margin-bottom: 8px;">Trạm sạc:</div>
                    <div class="tag-list">
                        @foreach($contact->charging_products as $product)
                            <span class="tag" style="background: #fef3c7; color: #b45309;">{{ $product }}</span>
                        @endforeach
                    </div>
                    @if($contact->charging_products_other)
                        <div style="margin-top: 8px; font-size: 13px; color: #64748b;">Khác: {{ $contact->charging_products_other }}</div>
                    @endif
                </div>
                @endif
            </div>
            @endif

            <!-- Intended Use & Purchase Plan -->
            <h2 class="section-title">Mục đích & Kế hoạch</h2>
            <div class="info-grid">
                @if($contact->intended_use)
                <div class="info-box">
                    <label>Mục đích sử dụng</label>
                    <span>
                        @if($contact->intended_use === 'b2c') Cá nhân (B2C)
                        @elseif($contact->intended_use === 'b2b') Doanh nghiệp / Logistics
                        @elseif($contact->intended_use === 'project') Dự án / Đội xe
                        @else Khác
                        @endif
                        @if($contact->intended_use === 'other' && $contact->intended_use_other)
                            : {{ $contact->intended_use_other }}
                        @endif
                    </span>
                </div>
                @endif
                @if($contact->estimated_budget)
                <div class="info-box">
                    <label>Ngân sách ước tính</label>
                    <span>
                        @if($contact->estimated_budget === 'under_500m') Dưới 500 triệu
                        @elseif($contact->estimated_budget === '500m_1b') 500 triệu - 1 tỷ
                        @elseif($contact->estimated_budget === '1b_3b') 1 tỷ - 3 tỷ
                        @elseif($contact->estimated_budget === '3b_5b') 3 tỷ - 5 tỷ
                        @else Trên 5 tỷ
                        @endif
                    </span>
                </div>
                @endif
                @if($contact->purchase_timeline)
                <div class="info-box">
                    <label>Thời gian dự kiến</label>
                    <span>
                        @if($contact->purchase_timeline === 'immediate') Ngay lập tức
                        @elseif($contact->purchase_timeline === '1_3_months') 1-3 tháng
                        @elseif($contact->purchase_timeline === '3_6_months') 3-6 tháng
                        @else Trên 6 tháng
                        @endif
                    </span>
                </div>
                @endif
            </div>

            <!-- Notes -->
            @if($contact->notes)
            <h2 class="section-title">Ghi chú / Yêu cầu kỹ thuật</h2>
            <div class="notes-box">{{ $contact->notes }}</div>
            @endif

            <div class="action-row">
                <a href="mailto:{{ $contact->email }}" class="btn btn-primary">
                    <i class="fas fa-envelope"></i> Gửi Email
                </a>
                <a href="tel:{{ $contact->phone }}" class="btn btn-success">
                    <i class="fas fa-phone"></i> Gọi điện
                </a>
                <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Xóa
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="update-section">
        <h2>Cập nhật trạng thái</h2>
        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="status">Trạng thái</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="new" {{ $contact->status === 'new' ? 'selected' : '' }}>Mới</option>
                    <option value="processing" {{ $contact->status === 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                    <option value="completed" {{ $contact->status === 'completed' ? 'selected' : '' }}>Đã giải quyết</option>
                </select>
            </div>
            <div class="form-group">
                <label for="admin_notes">Ghi chú nội bộ</label>
                <textarea name="admin_notes" id="admin_notes" class="form-control" placeholder="Thêm ghi chú...">{{ $contact->admin_notes }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Lưu thay đổi
            </button>
        </form>
        @if($contact->admin_notes)
            <div class="current-note">
                <strong>Ghi chú hiện tại:</strong> {{ $contact->admin_notes }}
            </div>
        @endif
    </div>
</div>
@endsection