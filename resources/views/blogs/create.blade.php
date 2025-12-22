@extends('layouts.app')

@section('title', 'Thêm bài viết mới')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<style>
    .blog-form-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .form-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .form-header h2 {
        font-size: 24px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #6b7280;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
    }

    .btn-back:hover {
        background: #4b5563;
        color: white;
    }

    .form-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #374151;
        font-size: 14px;
    }

    .form-group label .required {
        color: #ef4444;
    }

    .form-control {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: #ff4500;
        box-shadow: 0 0 0 3px rgba(255, 69, 0, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    #content {
        min-height: 400px;
    }

    .form-help {
        font-size: 13px;
        color: #6b7280;
        margin-top: 5px;
    }

    .image-preview {
        margin-top: 15px;
        display: none;
    }

    .image-preview img {
        max-width: 300px;
        max-height: 200px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        padding-top: 20px;
        border-top: 2px solid #f3f4f6;
    }

    .btn-submit {
        flex: 1;
        padding: 14px 24px;
        background: linear-gradient(135deg, #ff4500 0%, #ff6b35 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 69, 0, 0.3);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 69, 0, 0.4);
    }

    .btn-draft {
        flex: 1;
        padding: 14px 24px;
        background: #6b7280;
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-draft:hover {
        background: #4b5563;
    }

    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        border-left: 4px solid #ef4444;
    }

    .alert-danger ul {
        margin: 10px 0 0 20px;
    }
</style>

<div class="blog-form-container">
    <!-- Form Header -->
    <div class="form-header">
        <h2>Thêm bài viết mới</h2>
        <a href="{{ route('blogs.index') }}" class="btn-back">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M19 12H5M12 19l-7-7 7-7"/>
            </svg>
            Quay lại
        </a>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert-danger">
            <strong>Có lỗi xảy ra:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="form-card">
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
            @csrf

            <!-- Title -->
            <div class="form-group">
                <label for="title">Tiêu đề <span class="required">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <!-- Excerpt -->
            <div class="form-group">
                <label for="excerpt">Mô tả ngắn</label>
                <textarea class="form-control" id="excerpt" name="excerpt" rows="3">{{ old('excerpt') }}</textarea>
                <small class="form-help">Mô tả ngắn gọn về nội dung bài viết (tối đa 500 ký tự)</small>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category_id">Danh mục <span class="required">*</span></label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">-- Chọn danh mục --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Featured Image -->
            <div class="form-group">
                <label for="featured_image">Hình ảnh đại diện</label>
                <input type="file" class="form-control" id="featured_image" name="featured_image" accept="image/*" onchange="previewImage(event)">
                <small class="form-help">Định dạng: JPG, PNG, GIF, WEBP. Kích thước tối đa: 2MB</small>
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Preview" id="previewImg">
                </div>
            </div>

            <!-- Content -->
            <div class="form-group">
                <label for="content">Nội dung <span class="required">*</span></label>
                <input id="content" type="hidden" name="content" value="{{ old('content') }}">
                <trix-editor input="content" style="min-height: 400px; border: 1.5px solid #e5e7eb; border-radius: 8px;"></trix-editor>
                <small class="form-help">Nội dung chi tiết của bài viết. Hỗ trợ định dạng text, bold, italic, heading, list, link...</small>
            </div>

            <!-- Published At -->
            <div class="form-group">
                <label for="published_at">Ngày xuất bản</label>
                <input type="datetime-local" class="form-control" id="published_at" name="published_at" value="{{ old('published_at') }}">
                <small class="form-help">Để trống để sử dụng ngày giờ hiện tại khi xuất bản</small>
            </div>

            <!-- Hidden Status Field -->
            <input type="hidden" name="status" id="status" value="published">

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-submit" onclick="setStatus('published')">
                    Xuất bản ngay
                </button>
                <button type="submit" class="btn-draft" onclick="setStatus('draft')">
                    Lưu bản nháp
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    }

    function setStatus(status) {
        document.getElementById('status').value = status;
    }
</script>
<script src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
@endsection
