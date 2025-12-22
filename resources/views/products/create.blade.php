@extends('layouts.app')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<style>
    /* Form Container Styles */
    .form-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    /* Page Header */
    .form-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
    }

    .form-page-header h2 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0 0 5px 0;
    }

    .form-page-header p {
        color: #6b7280;
        margin: 0;
        font-size: 14px;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        margin-bottom: 25px;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: 600;
        color: #1a1a2e;
        margin: 0 0 25px 0;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 20px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-label.required::after {
        content: ' *';
        color: #ff4500;
    }

    .form-input, .form-select, .form-textarea {
        display: block;
        width: 100%;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 14px;
        transition: all 0.3s ease;
        background: white;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #ff4500;
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    .form-input.error, .form-select.error, .form-textarea.error {
        border-color: #ef4444;
    }

    .form-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .form-hint {
        font-size: 12px;
        color: #6b7280;
        margin-top: 6px;
    }

    .form-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-grid-full {
        grid-column: 1 / -1;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
        padding: 25px 30px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #f0f0f0;
        position: sticky;
        bottom: 20px;
        z-index: 10;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
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

    .btn svg {
        width: 18px;
        height: 18px;
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

    .alert-error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #dc2626;
    }

    .alert svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
    }
</style>

<div class="form-container">
    <!-- Page Header -->
    <div class="form-page-header">
        <div>
            <h2>Thêm sản phẩm mới</h2>
            <p>Điền thông tin để tạo sản phẩm mới</p>
        </div>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div>
                <strong>Có lỗi xảy ra:</strong>
                <ul style="margin: 5px 0 0 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Thông tin cơ bản -->
    <div class="form-card">
        <h3 class="form-section-title">Thông tin cơ bản</h3>
        
        <div class="form-grid">
            <!-- Tên sản phẩm -->
            <div class="form-group form-grid-full">
                <label for="name" class="form-label required">Tên sản phẩm</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="form-input @error('name') error @enderror"
                    placeholder="Nhập tên sản phẩm">
                @error('name')
                    <p class="form-error">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="16" height="16">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- SKU -->
            <div class="form-group">
                <label for="sku" class="form-label">Mã SKU</label>
                <input type="text" name="sku" id="sku" value="{{ old('sku') }}"
                    class="form-input @error('sku') error @enderror"
                    placeholder="VD: EV-001">
                <p class="form-hint">Mã định danh duy nhất cho sản phẩm</p>
                @error('sku')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Trạng thái -->
            <div class="form-group">
                <label for="status" class="form-label required">Trạng thái</label>
                <select name="status" id="status" required
                    class="form-select @error('status') error @enderror">
                    <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Ngừng bán</option>
                </select>
                @error('status')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sản phẩm nổi bật -->
            <div class="form-group">
                <label class="form-label" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" 
                        {{ old('is_featured') ? 'checked' : '' }}
                        style="width: 20px; height: 20px; cursor: pointer; accent-color: #ff4500;">
                    <span style="font-weight: 600; color: #374151;">Sản phẩm nổi bật</span>
                </label>
                <p class="form-hint">Sản phẩm nổi bật sẽ được hiển thị ở trang chủ</p>
                @error('is_featured')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thương hiệu -->
            <div class="form-group">
                <label for="brand_name" class="form-label">Thương hiệu</label>
                <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}"
                    class="form-input @error('brand_name') error @enderror"
                    placeholder="Nhập tên thương hiệu (VD: Tesla, BYD, VinFast)">
                @error('brand_name')
                    <p class="form-error">{{ $message }}</p>
                @enderror
                <p class="form-hint">Tên thương hiệu sẽ tự động được tạo nếu chưa tồn tại</p>
            </div>

            <!-- Danh mục -->
            <div class="form-group">
                <label for="category_id" class="form-label">Danh mục</label>
                <select name="category_id" id="category_id"
                    class="form-select @error('category_id') error @enderror">
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Giá -->
            <div class="form-group">
                <label for="msrp_price" class="form-label">Giá bán (VND)</label>
                <input type="number" name="msrp_price" id="msrp_price" value="{{ old('msrp_price') }}" step="1000" min="0"
                    class="form-input @error('msrp_price') error @enderror"
                    placeholder="0">
                <p class="form-hint">Giá bán đề xuất của nhà sản xuất</p>
                @error('msrp_price')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Đơn vị tiền tệ -->
            <div class="form-group">
                <label for="currency" class="form-label">Đơn vị tiền tệ</label>
                <input type="text" name="currency" id="currency" value="{{ old('currency', 'VND') }}" maxlength="3"
                    class="form-input @error('currency') error @enderror"
                    placeholder="VND">
                @error('currency')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Ngày phát hành -->
            <div class="form-group">
                <label for="release_date" class="form-label">Ngày phát hành</label>
                <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}"
                    class="form-input @error('release_date') error @enderror">
                @error('release_date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bảo hành -->
            <div class="form-group">
                <label for="warranty_years" class="form-label">Bảo hành (năm)</label>
                <input type="number" name="warranty_years" id="warranty_years" value="{{ old('warranty_years') }}" min="0" step="1"
                    class="form-input @error('warranty_years') error @enderror"
                    placeholder="0">
                @error('warranty_years')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bảo hành km -->
            <div class="form-group">
                <label for="warranty_km" class="form-label">Bảo hành (km)</label>
                <input type="number" name="warranty_km" id="warranty_km" value="{{ old('warranty_km') }}" min="0" step="1000"
                    class="form-input @error('warranty_km') error @enderror"
                    placeholder="0">
                @error('warranty_km')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Mô tả -->
    <div class="form-card">
        <h3 class="form-section-title">Mô tả sản phẩm</h3>
        
        <div class="form-grid">
            <!-- Mô tả ngắn -->
            <div class="form-group form-grid-full">
                <label for="short_description" class="form-label">Mô tả ngắn</label>
                <textarea name="short_description" id="short_description" rows="3"
                    class="form-textarea @error('short_description') error @enderror"
                    placeholder="Mô tả ngắn gọn về sản phẩm (hiển thị trên trang danh sách)">{{ old('short_description') }}</textarea>
                @error('short_description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Mô tả chi tiết -->
            <div class="form-group form-grid-full">
                <label for="description" class="form-label">Mô tả chi tiết</label>
                <textarea name="description" id="description" rows="8"
                    class="form-textarea @error('description') error @enderror"
                    placeholder="Mô tả đầy đủ về sản phẩm, tính năng, ưu điểm...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Thông số kỹ thuật EV (6 trường cơ bản) -->
    <div class="form-card">
        <h3 class="form-section-title">Thông số kỹ thuật xe điện</h3>
        
        <div class="form-grid">
            <!-- RANGE -->
            <div class="form-group">
                <label for="range_km" class="form-label">Range (Phạm vi)</label>
                <input type="text" name="range_km" id="range_km" value="{{ old('range_km') }}"
                    class="form-input @error('range_km') error @enderror"
                    placeholder="VD: 180 km (CHTC Driving Range)">
                <p class="form-hint">Phạm vi hoạt động của xe</p>
                @error('range_km')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- CHARGE -->
            <div class="form-group">
                <label for="charge_description" class="form-label">Charge (Sạc)</label>
                <input type="text" name="charge_description" id="charge_description" value="{{ old('charge_description') }}"
                    class="form-input @error('charge_description') error @enderror"
                    placeholder="VD: DC fast charging (10-80% in 60 min, 7 kW OBC)">
                <p class="form-hint">Thông tin về khả năng sạc</p>
                @error('charge_description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- 0-100 KM/H -->
            <div class="form-group">
                <label for="zero_to_100_kmh" class="form-label">0-100 km/h</label>
                <input type="text" name="zero_to_100_kmh" id="zero_to_100_kmh" value="{{ old('zero_to_100_kmh') }}"
                    class="form-input @error('zero_to_100_kmh') error @enderror"
                    placeholder="VD: N/A (commercial vehicle)">
                <p class="form-hint">Thời gian tăng tốc 0-100 km/h</p>
                @error('zero_to_100_kmh')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- POWER -->
            <div class="form-group">
                <label for="power_kw" class="form-label">Power (Công suất)</label>
                <input type="text" name="power_kw" id="power_kw" value="{{ old('power_kw') }}"
                    class="form-input @error('power_kw') error @enderror"
                    placeholder="VD: 105 kW (300 Nm)">
                <p class="form-hint">Công suất và mô-men xoắn</p>
                @error('power_kw')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- DRIVETRAIN -->
            <div class="form-group">
                <label for="drivetrain" class="form-label">Drivetrain (Hệ dẫn động)</label>
                <input type="text" name="drivetrain" id="drivetrain" value="{{ old('drivetrain') }}"
                    class="form-input @error('drivetrain') error @enderror"
                    placeholder="VD: Rear-wheel drive (single motor)">
                <p class="form-hint">Loại hệ dẫn động</p>
                @error('drivetrain')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- BATTERY -->
            <div class="form-group">
                <label for="battery_capacity_kwh" class="form-label">Battery (Pin)</label>
                <input type="text" name="battery_capacity_kwh" id="battery_capacity_kwh" value="{{ old('battery_capacity_kwh') }}"
                    class="form-input @error('battery_capacity_kwh') error @enderror"
                    placeholder="VD: 66.84 kWh lithium-ion (Ningde)">
                <p class="form-hint">Dung lượng và loại pin</p>
                @error('battery_capacity_kwh')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <!-- Hình ảnh sản phẩm -->
    <div class="form-card">
        <h3 class="form-section-title">Hình ảnh sản phẩm</h3>
        
        <div class="form-group">
            <label for="images" class="form-label">Thêm hình ảnh</label>
            <input type="file" name="images[]" id="images" multiple accept="image/*"
                class="form-input @error('images.*') error @enderror"
                onchange="previewImages(event)">
            <p class="form-hint">Chọn nhiều ảnh cùng lúc. Ảnh đầu tiên sẽ là ảnh chính. Định dạng: JPG, PNG, GIF, WebP. Tối đa: 5MB/ảnh</p>
            @error('images.*')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Image Preview Container -->
        <div id="imagePreviewContainer" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 15px; margin-top: 20px;">
            <!-- Preview images will be inserted here -->
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="form-actions">
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Hủy bỏ
        </a>
        <button type="submit" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            Tạo sản phẩm
        </button>
    </div>
</form>
</div>

<script>
function previewImages(event) {
    const container = document.getElementById('imagePreviewContainer');
    container.innerHTML = ''; // Clear previous previews
    
    const files = event.target.files;
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const previewDiv = document.createElement('div');
            previewDiv.style.cssText = 'position: relative; border-radius: 8px; overflow: hidden; border: 2px solid #e5e7eb; background: #f9fafb;';
            
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width: 100%; height: 150px; object-fit: cover; display: block;';
            
            const label = document.createElement('div');
            label.textContent = i === 0 ? 'Ảnh chính' : `Ảnh ${i + 1}`;
            label.style.cssText = 'padding: 8px; text-align: center; font-size: 12px; font-weight: 600; color: #374151; background: ' + (i === 0 ? '#10b981' : '#e5e7eb') + '; color: ' + (i === 0 ? 'white' : '#374151');
            
            previewDiv.appendChild(img);
            previewDiv.appendChild(label);
            container.appendChild(previewDiv);
        };
        
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
