import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';
import Layout from '../layout/Layout';

function Blog() {
    const [posts, setPosts] = useState([]);
    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);
    const [selectedCategory, setSelectedCategory] = useState('');
    const [searchQuery, setSearchQuery] = useState('');
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);

    useEffect(() => {
        fetchPosts();
        fetchCategories();
    }, [selectedCategory, searchQuery, currentPage]);

    const fetchPosts = async () => {
        setLoading(true);
        try {
            const params = {
                page: currentPage,
                per_page: 9,
            };

            if (selectedCategory) {
                params.category_id = selectedCategory;
            }

            if (searchQuery) {
                params.search = searchQuery;
            }

            const response = await axios.get('/api/blogs', { params });
            setPosts(response.data.data);
            setTotalPages(response.data.last_page);
        } catch (error) {
            console.error('Error fetching posts:', error);
        } finally {
            setLoading(false);
        }
    };

    const fetchCategories = async () => {
        try {
            const response = await axios.get('/api/blog-categories');
            setCategories(response.data);
        } catch (error) {
            console.error('Error fetching categories:', error);
        }
    };

    const handleCategoryChange = (categoryId) => {
        setSelectedCategory(categoryId);
        setCurrentPage(1);
    };

    const handleSearch = (e) => {
        e.preventDefault();
        setCurrentPage(1);
        fetchPosts();
    };

    const stripHtml = (html) => {
        const tmp = document.createElement('DIV');
        tmp.innerHTML = html;
        return tmp.textContent || tmp.innerText || '';
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('vi-VN', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    };

    return (
        <Layout>
        <div className="blog-page" style={{ minHeight: '100vh', background: '#f9fafb', paddingTop: '80px' }}>
            {/* Hero Section */}
            <div style={{
                background: 'linear-gradient(135deg, #1a1a2e 0%, #16213e 100%)',
                padding: '80px 20px',
                textAlign: 'center',
                color: 'white',
                marginBottom: '60px'
            }}>
                <div style={{ maxWidth: '800px', margin: '0 auto' }}>
                    <h1 style={{
                        fontSize: '48px',
                        fontWeight: '700',
                        marginBottom: '20px',
                        background: 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)',
                        WebkitBackgroundClip: 'text',
                        WebkitTextFillColor: 'transparent'
                    }}>
                        Tin tức & Blog
                    </h1>
                    <p style={{ fontSize: '18px', color: '#cbd5e1', lineHeight: '1.6' }}>
                        Cập nhật tin tức mới nhất về xe điện, công nghệ và xu hướng thị trường
                    </p>
                </div>
            </div>

            <div className="container" style={{ maxWidth: '1200px', margin: '0 auto', padding: '0 20px 80px' }}>
                {/* Filter & Search Section */}
                <div style={{
                    background: 'white',
                    padding: '30px',
                    borderRadius: '15px',
                    boxShadow: '0 2px 10px rgba(0,0,0,0.05)',
                    marginBottom: '40px'
                }}>
                    <div style={{ display: 'flex', gap: '20px', flexWrap: 'wrap', alignItems: 'center' }}>
                        {/* Search */}
                        <form onSubmit={handleSearch} style={{ flex: '1', minWidth: '250px' }}>
                            <div style={{ position: 'relative' }}>
                                <input
                                    type="text"
                                    placeholder="Tìm kiếm bài viết..."
                                    value={searchQuery}
                                    onChange={(e) => setSearchQuery(e.target.value)}
                                    style={{
                                        width: '100%',
                                        padding: '12px 45px 12px 15px',
                                        border: '1.5px solid #e5e7eb',
                                        borderRadius: '10px',
                                        fontSize: '15px',
                                        transition: 'all 0.2s'
                                    }}
                                    onFocus={(e) => e.target.style.borderColor = '#ff4500'}
                                    onBlur={(e) => e.target.style.borderColor = '#e5e7eb'}
                                />
                                <button type="submit" style={{
                                    position: 'absolute',
                                    right: '10px',
                                    top: '50%',
                                    transform: 'translateY(-50%)',
                                    background: 'transparent',
                                    border: 'none',
                                    cursor: 'pointer',
                                    color: '#ff4500'
                                }}>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.35-4.35"></path>
                                    </svg>
                                </button>
                            </div>
                        </form>

                        {/* Category Filter */}
                        <div style={{ display: 'flex', gap: '10px', flexWrap: 'wrap' }}>
                            <button
                                onClick={() => handleCategoryChange('')}
                                style={{
                                    padding: '10px 20px',
                                    border: 'none',
                                    borderRadius: '25px',
                                    background: selectedCategory === '' ? 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)' : '#f3f4f6',
                                    color: selectedCategory === '' ? 'white' : '#374151',
                                    fontWeight: '600',
                                    cursor: 'pointer',
                                    transition: 'all 0.2s',
                                    fontSize: '14px'
                                }}
                            >
                                Tất cả
                            </button>
                            {categories.map(category => (
                                <button
                                    key={category.id}
                                    onClick={() => handleCategoryChange(category.id)}
                                    style={{
                                        padding: '10px 20px',
                                        border: 'none',
                                        borderRadius: '25px',
                                        background: selectedCategory === category.id ? 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)' : '#f3f4f6',
                                        color: selectedCategory === category.id ? 'white' : '#374151',
                                        fontWeight: '600',
                                        cursor: 'pointer',
                                        transition: 'all 0.2s',
                                        fontSize: '14px'
                                    }}
                                >
                                    {category.name} ({category.posts_count || 0})
                                </button>
                            ))}
                        </div>
                    </div>
                </div>

                {/* Loading State */}
                {loading && (
                    <div style={{ textAlign: 'center', padding: '60px 0' }}>
                        <div style={{
                            width: '50px',
                            height: '50px',
                            border: '4px solid #f3f4f6',
                            borderTop: '4px solid #ff4500',
                            borderRadius: '50%',
                            animation: 'spin 1s linear infinite',
                            margin: '0 auto'
                        }}></div>
                    </div>
                )}

                {/* Blog Grid */}
                {!loading && posts.length > 0 && (
                    <div style={{
                        display: 'grid',
                        gridTemplateColumns: 'repeat(auto-fill, minmax(350px, 1fr))',
                        gap: '30px',
                        marginBottom: '40px'
                    }}>
                        {posts.map(post => (
                            <Link
                                key={post.id}
                                to={`/blog/${post.slug}`}
                                style={{
                                    textDecoration: 'none',
                                    color: 'inherit',
                                    background: 'white',
                                    borderRadius: '15px',
                                    overflow: 'hidden',
                                    boxShadow: '0 2px 10px rgba(0,0,0,0.05)',
                                    transition: 'all 0.3s',
                                    cursor: 'pointer'
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.transform = 'translateY(-5px)';
                                    e.currentTarget.style.boxShadow = '0 10px 30px rgba(0,0,0,0.15)';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.transform = 'translateY(0)';
                                    e.currentTarget.style.boxShadow = '0 2px 10px rgba(0,0,0,0.05)';
                                }}
                            >
                                {/* Image */}
                                <div style={{
                                    width: '100%',
                                    height: '220px',
                                    overflow: 'hidden',
                                    position: 'relative'
                                }}>
                                    {post.featured_image ? (
                                        <img
                                            src={post.featured_image}
                                            alt={post.title}
                                            style={{
                                                width: '100%',
                                                height: '100%',
                                                objectFit: 'cover',
                                                transition: 'transform 0.3s'
                                            }}
                                            onError={(e) => {
                                                e.target.style.display = 'none';
                                                e.target.nextElementSibling.style.display = 'flex';
                                            }}
                                            onMouseEnter={(e) => e.target.style.transform = 'scale(1.05)'}
                                            onMouseLeave={(e) => e.target.style.transform = 'scale(1)'}  
                                        />
                                    ) : null}
                                    <div style={{
                                        width: '100%',
                                        height: '100%',
                                        background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                                        display: post.featured_image ? 'none' : 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center',
                                        color: 'white',
                                        fontSize: '48px',
                                        fontWeight: '700'
                                    }}>
                                        {post.title.charAt(0)}
                                    </div>

                                    {/* Category Badge */}
                                    <div style={{
                                        position: 'absolute',
                                        top: '15px',
                                        left: '15px',
                                        background: 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)',
                                        color: 'white',
                                        padding: '6px 14px',
                                        borderRadius: '20px',
                                        fontSize: '12px',
                                        fontWeight: '600'
                                    }}>
                                        {post.category?.name}
                                    </div>
                                </div>

                                {/* Content */}
                                <div style={{ padding: '25px' }}>
                                    {/* Meta Info */}
                                    <div style={{
                                        display: 'flex',
                                        gap: '15px',
                                        marginBottom: '15px',
                                        fontSize: '13px',
                                        color: '#6b7280'
                                    }}>
                                        <span style={{ display: 'flex', alignItems: 'center', gap: '5px' }}>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                            {post.author?.name}
                                        </span>
                                        <span style={{ display: 'flex', alignItems: 'center', gap: '5px' }}>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                                <line x1="3" y1="10" x2="21" y2="10"></line>
                                            </svg>
                                            {formatDate(post.published_at)}
                                        </span>
                                        <span style={{ display: 'flex', alignItems: 'center', gap: '5px' }}>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            {post.views_count}
                                        </span>
                                    </div>

                                    {/* Title */}
                                    <h3 style={{
                                        fontSize: '20px',
                                        fontWeight: '700',
                                        marginBottom: '12px',
                                        color: '#1a1a2e',
                                        lineHeight: '1.4',
                                        display: '-webkit-box',
                                        WebkitLineClamp: '2',
                                        WebkitBoxOrient: 'vertical',
                                        overflow: 'hidden'
                                    }}>
                                        {post.title}
                                    </h3>

                                    {/* Excerpt */}
                                    <p style={{
                                        color: '#6b7280',
                                        fontSize: '14px',
                                        lineHeight: '1.6',
                                        marginBottom: '15px',
                                        display: '-webkit-box',
                                        WebkitLineClamp: '3',
                                        WebkitBoxOrient: 'vertical',
                                        overflow: 'hidden'
                                    }}>
                                        {post.excerpt || stripHtml(post.content).substring(0, 150) + '...'}
                                    </p>

                                    {/* Read More */}
                                    <div style={{
                                        color: '#ff4500',
                                        fontWeight: '600',
                                        fontSize: '14px',
                                        display: 'flex',
                                        alignItems: 'center',
                                        gap: '5px'
                                    }}>
                                        Đọc thêm
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </Link>
                        ))}
                    </div>
                )}

                {/* Empty State */}
                {!loading && posts.length === 0 && (
                    <div style={{
                        textAlign: 'center',
                        padding: '80px 20px',
                        background: 'white',
                        borderRadius: '15px'
                    }}>
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" strokeWidth="2" style={{ margin: '0 auto 20px' }}>
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2z"/>
                            <path d="M3 9h18"/>
                            <path d="M9 21V9"/>
                        </svg>
                        <h3 style={{ fontSize: '24px', color: '#374151', marginBottom: '10px' }}>
                            Không tìm thấy bài viết
                        </h3>
                        <p style={{ color: '#6b7280' }}>
                            Thử tìm kiếm với từ khóa khác hoặc chọn danh mục khác
                        </p>
                    </div>
                )}

                {/* Pagination */}
                {!loading && posts.length > 0 && totalPages > 1 && (
                    <div style={{
                        display: 'flex',
                        justifyContent: 'center',
                        gap: '10px',
                        marginTop: '40px'
                    }}>
                        <button
                            onClick={() => setCurrentPage(prev => Math.max(1, prev - 1))}
                            disabled={currentPage === 1}
                            style={{
                                padding: '10px 20px',
                                border: 'none',
                                borderRadius: '8px',
                                background: currentPage === 1 ? '#f3f4f6' : 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)',
                                color: currentPage === 1 ? '#9ca3af' : 'white',
                                fontWeight: '600',
                                cursor: currentPage === 1 ? 'not-allowed' : 'pointer',
                                transition: 'all 0.2s'
                            }}
                        >
                            ← Trước
                        </button>

                        <div style={{
                            display: 'flex',
                            alignItems: 'center',
                            padding: '0 20px',
                            fontWeight: '600',
                            color: '#374151'
                        }}>
                            Trang {currentPage} / {totalPages}
                        </div>

                        <button
                            onClick={() => setCurrentPage(prev => Math.min(totalPages, prev + 1))}
                            disabled={currentPage === totalPages}
                            style={{
                                padding: '10px 20px',
                                border: 'none',
                                borderRadius: '8px',
                                background: currentPage === totalPages ? '#f3f4f6' : 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)',
                                color: currentPage === totalPages ? '#9ca3af' : 'white',
                                fontWeight: '600',
                                cursor: currentPage === totalPages ? 'not-allowed' : 'pointer',
                                transition: 'all 0.2s'
                            }}
                        >
                            Sau →
                        </button>
                    </div>
                )}
            </div>

            <style>{`
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
            `}</style>
        </div>
        </Layout>
    );
}

export default Blog;
