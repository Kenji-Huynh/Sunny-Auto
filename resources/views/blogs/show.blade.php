@extends('layouts.app')

@section('title', $blog->title)

@section('content')
<style>
    .blog-view-container {
        max-width: 900px;
        margin: 0 auto;
    }

    .view-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
        gap: 20px;
    }

    .view-header-left {
        flex: 1;
    }

    .view-header-left h1 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a2e;
        margin: 0 0 15px 0;
        line-height: 1.3;
    }

    .post-meta-info {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        color: #6b7280;
        font-size: 14px;
    }

    .post-meta-info span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

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

    .action-buttons {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-back {
        background: #6b7280;
        color: white;
    }

    .btn-back:hover {
        background: #4b5563;
        color: white;
    }

    .btn-edit {
        background: #fbbf24;
        color: #78350f;
    }

    .btn-edit:hover {
        background: #f59e0b;
    }

    .btn-delete {
        background: #ef4444;
        color: white;
    }

    .btn-delete:hover {
        background: #dc2626;
    }

    .blog-content-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .featured-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }

    .blog-content {
        padding: 40px;
    }

    .blog-excerpt {
        font-size: 18px;
        color: #6b7280;
        font-style: italic;
        margin-bottom: 30px;
        padding-left: 20px;
        border-left: 4px solid #ff4500;
    }

    .blog-body {
        font-size: 16px;
        line-height: 1.8;
        color: #374151;
    }

    .blog-body h1,
    .blog-body h2,
    .blog-body h3 {
        color: #1a1a2e;
        margin-top: 30px;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .blog-body h1 { font-size: 28px; }
    .blog-body h2 { font-size: 24px; }
    .blog-body h3 { font-size: 20px; }

    .blog-body p {
        margin-bottom: 20px;
    }

    .blog-body ul,
    .blog-body ol {
        margin-bottom: 20px;
        padding-left: 30px;
    }

    .blog-body li {
        margin-bottom: 10px;
    }

    .blog-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    .blog-footer {
        background: #f9fafb;
        padding: 25px 40px;
        border-top: 1px solid #e5e7eb;
    }

    .footer-info {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-item label {
        font-size: 12px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .info-item span {
        font-size: 14px;
        color: #374151;
        font-weight: 600;
    }

    .comments-section {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .comments-header {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a2e;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f3f4f6;
    }

    .comment-item {
        padding: 15px;
        background: #f9fafb;
        border-radius: 10px;
        margin-bottom: 15px;
    }

    .comment-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .comment-author {
        font-weight: 600;
        color: #374151;
    }

    .comment-date {
        font-size: 12px;
        color: #6b7280;
    }

    .comment-content {
        color: #374151;
        font-size: 14px;
        line-height: 1.6;
    }

    .empty-comments {
        text-align: center;
        padding: 40px;
        color: #6b7280;
    }
</style>

<div class="blog-view-container">
    <!-- View Header -->
    <div class="view-header">
        <div class="view-header-left">
            <h1>{{ $blog->title }}</h1>
            <div class="post-meta-info">
                <span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    {{ $blog->author->name }}
                </span>
                <span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    {{ $blog->created_at->format('d/m/Y') }}
                </span>
                <span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    {{ number_format($blog->views_count) }} lượt xem
                </span>
                <span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    {{ $blog->category->name }}
                </span>
                <span class="status-badge status-{{ $blog->status }}">
                    {{ $blog->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                </span>
            </div>
        </div>
        <div class="action-buttons">
            <a href="{{ route('blogs.index') }}" class="btn-action btn-back">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
                Quay lại
            </a>
            <a href="{{ route('blogs.edit', $blog) }}" class="btn-action btn-edit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                Sửa
            </a>
            <form action="{{ route('blogs.destroy', $blog) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-action btn-delete">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                    Xóa
                </button>
            </form>
        </div>
    </div>

    <!-- Blog Content Card -->
    <div class="blog-content-card">
        @if($blog->featured_image)
            <img src="{{ asset($blog->featured_image) }}" alt="{{ $blog->title }}" class="featured-image">
        @endif

        <div class="blog-content">
            @if($blog->excerpt)
                <div class="blog-excerpt">
                    {{ $blog->excerpt }}
                </div>
            @endif

            <div class="blog-body">
                {!! $blog->content !!}
            </div>
        </div>

        <div class="blog-footer">
            <div class="footer-info">
                <div class="info-item">
                    <label>Tác giả</label>
                    <span>{{ $blog->author->name }}</span>
                </div>
                <div class="info-item">
                    <label>Danh mục</label>
                    <span>{{ $blog->category->name }}</span>
                </div>
                <div class="info-item">
                    <label>Lượt xem</label>
                    <span>{{ number_format($blog->views_count) }}</span>
                </div>
                <div class="info-item">
                    <label>Thời gian đọc</label>
                    <span>{{ $blog->reading_time }} phút</span>
                </div>
                <div class="info-item">
                    <label>Ngày tạo</label>
                    <span>{{ $blog->created_at->format('d/m/Y H:i') }}</span>
                </div>
                @if($blog->published_at)
                    <div class="info-item">
                        <label>Ngày xuất bản</label>
                        <span>{{ $blog->published_at->format('d/m/Y H:i') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <div class="comments-header">
            Bình luận ({{ $blog->comments->count() }})
        </div>

        @if($blog->comments->count() > 0)
            @foreach($blog->comments as $comment)
                <div class="comment-item">
                    <div class="comment-header">
                        <span class="comment-author">{{ $comment->authorDisplayName }}</span>
                        <span class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="comment-content">
                        {{ $comment->content }}
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-comments">
                <p>Chưa có bình luận nào</p>
            </div>
        @endif
    </div>
</div>
@endsection
