import React, { useState, useEffect } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import Layout from '../layout/Layout';

function BlogDetail() {
    const { slug } = useParams();
    const navigate = useNavigate();
    const [post, setPost] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        window.scrollTo(0, 0);
        fetchPost();
    }, [slug]);

    const fetchPost = async () => {
        setLoading(true);
        setError(null);
        try {
            const response = await axios.get(`/api/blogs/${slug}`);
            setPost(response.data);
        } catch (error) {
            console.error('Error fetching post:', error);
            setError('Không tìm thấy bài viết hoặc bài viết chưa được xuất bản.');
        } finally {
            setLoading(false);
        }
    };

    const formatDate = (dateString) => {
        const date = new Date(dateString);
        return date.toLocaleDateString('vi-VN', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    };

    if (loading) {
        return (
            <div style={{
                minHeight: '100vh',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                background: '#f9fafb'
            }}>
                <div style={{
                    width: '60px',
                    height: '60px',
                    border: '4px solid #f3f4f6',
                    borderTop: '4px solid #ff4500',
                    borderRadius: '50%',
                    animation: 'spin 1s linear infinite'
                }}></div>
                <style>{`
                    @keyframes spin {
                        to { transform: rotate(360deg); }
                    }
                `}</style>
            </div>
        );
    }

    if (error || !post) {
        return (
            <div style={{
                minHeight: '100vh',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center',
                background: '#f9fafb',
                padding: '20px'
            }}>
                <div style={{
                    background: 'white',
                    padding: '60px 40px',
                    borderRadius: '15px',
                    textAlign: 'center',
                    maxWidth: '500px',
                    boxShadow: '0 10px 40px rgba(0,0,0,0.1)'
                }}>
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#ef4444" strokeWidth="2" style={{ margin: '0 auto 20px' }}>
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <h2 style={{ fontSize: '24px', marginBottom: '15px', color: '#1a1a2e' }}>
                        Không tìm thấy bài viết
                    </h2>
                    <p style={{ color: '#6b7280', marginBottom: '30px' }}>
                        {error}
                    </p>
                    <Link
                        to="/blog"
                        style={{
                            display: 'inline-block',
                            padding: '12px 30px',
                            background: 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)',
                            color: 'white',
                            borderRadius: '10px',
                            textDecoration: 'none',
                            fontWeight: '600'
                        }}
                    >
                        ← Quay lại danh sách
                    </Link>
                </div>
            </div>
        );
    }

    return (
        <Layout>
        <div style={{ minHeight: '100vh', background: '#f9fafb', paddingTop: '80px' }}>
            {/* Back Button */}
            <div style={{ background: 'white', borderBottom: '1px solid #e5e7eb', padding: '15px 0' }}>
                <div style={{ maxWidth: '900px', margin: '0 auto', padding: '0 20px' }}>
                    <button
                        onClick={() => navigate('/blog')}
                        style={{
                            display: 'inline-flex',
                            alignItems: 'center',
                            gap: '8px',
                            padding: '8px 16px',
                            background: '#f3f4f6',
                            border: 'none',
                            borderRadius: '8px',
                            color: '#374151',
                            fontWeight: '600',
                            cursor: 'pointer',
                            transition: 'all 0.2s',
                            fontSize: '14px'
                        }}
                        onMouseEnter={(e) => e.target.style.background = '#e5e7eb'}
                        onMouseLeave={(e) => e.target.style.background = '#f3f4f6'}
                    >
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M19 12H5M12 19l-7-7 7-7"/>
                        </svg>
                        Quay lại
                    </button>
                </div>
            </div>

            {/* Article Container */}
            <div style={{ maxWidth: '900px', margin: '0 auto', padding: '40px 20px 80px' }}>
                {/* Article Header */}
                <article style={{ background: 'white', borderRadius: '15px', overflow: 'hidden', boxShadow: '0 2px 10px rgba(0,0,0,0.05)' }}>
                    {/* Featured Image */}
                    {post.featured_image && (
                        <div style={{ width: '100%', maxHeight: '500px', overflow: 'hidden', position: 'relative' }}>
                            <img
                                src={post.featured_image}
                                alt={post.title}
                                style={{ width: '100%', height: 'auto', display: 'block' }}
                                onError={(e) => {
                                    e.target.style.display = 'none';
                                    e.target.nextElementSibling.style.display = 'flex';
                                }}
                            />
                            <div style={{
                                width: '100%',
                                height: '400px',
                                background: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                                display: 'none',
                                alignItems: 'center',
                                justifyContent: 'center',
                                color: 'white',
                                fontSize: '120px',
                                fontWeight: '700'
                            }}>
                                {post.title.charAt(0)}
                            </div>
                        </div>
                    )}

                    {/* Content */}
                    <div style={{ padding: '50px' }}>
                        {/* Category Badge */}
                        <div style={{ marginBottom: '20px' }}>
                            <span style={{
                                display: 'inline-block',
                                background: 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)',
                                color: 'white',
                                padding: '8px 18px',
                                borderRadius: '25px',
                                fontSize: '13px',
                                fontWeight: '600',
                                textTransform: 'uppercase',
                                letterSpacing: '0.5px'
                            }}>
                                {post.category?.name}
                            </span>
                        </div>

                        {/* Title */}
                        <h1 style={{
                            fontSize: '42px',
                            fontWeight: '700',
                            lineHeight: '1.3',
                            color: '#1a1a2e',
                            marginBottom: '25px'
                        }}>
                            {post.title}
                        </h1>

                        {/* Meta Info */}
                        <div style={{
                            display: 'flex',
                            gap: '25px',
                            paddingBottom: '25px',
                            marginBottom: '35px',
                            borderBottom: '2px solid #f3f4f6',
                            flexWrap: 'wrap',
                            fontSize: '15px',
                            color: '#6b7280'
                        }}>
                            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <strong style={{ color: '#374151' }}>{post.author?.name}</strong>
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {formatDate(post.published_at)}
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                {post.views_count.toLocaleString()} lượt xem
                            </div>
                            <div style={{ display: 'flex', alignItems: 'center', gap: '8px' }}>
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {post.reading_time} phút đọc
                            </div>
                        </div>

                        {/* Excerpt */}
                        {post.excerpt && (
                            <div style={{
                                fontSize: '20px',
                                lineHeight: '1.7',
                                color: '#4b5563',
                                fontStyle: 'italic',
                                paddingLeft: '25px',
                                borderLeft: '4px solid #ff4500',
                                marginBottom: '40px'
                            }}>
                                {post.excerpt}
                            </div>
                        )}

                        {/* Article Content */}
                        <div
                            style={{
                                fontSize: '17px',
                                lineHeight: '1.8',
                                color: '#374151'
                            }}
                            className="blog-content"
                            dangerouslySetInnerHTML={{ __html: post.content }}
                        />
                    </div>

                    {/* Article Footer */}
                    <div style={{
                        background: '#f9fafb',
                        padding: '30px 50px',
                        borderTop: '1px solid #e5e7eb'
                    }}>
                        <div style={{
                            display: 'flex',
                            justifyContent: 'space-between',
                            alignItems: 'center',
                            flexWrap: 'wrap',
                            gap: '20px'
                        }}>
                            <div>
                                <div style={{ fontSize: '13px', color: '#6b7280', marginBottom: '5px', textTransform: 'uppercase', letterSpacing: '0.5px' }}>
                                    Tác giả
                                </div>
                                <div style={{ fontSize: '16px', fontWeight: '600', color: '#1a1a2e' }}>
                                    {post.author?.name}
                                </div>
                            </div>
                            <div style={{ textAlign: 'right' }}>
                                <div style={{ fontSize: '13px', color: '#6b7280', marginBottom: '5px', textTransform: 'uppercase', letterSpacing: '0.5px' }}>
                                    Chia sẻ
                                </div>
                                <div style={{ display: 'flex', gap: '10px' }}>
                                    <button style={{
                                        padding: '8px 12px',
                                        background: '#1877f2',
                                        color: 'white',
                                        border: 'none',
                                        borderRadius: '6px',
                                        cursor: 'pointer',
                                        fontWeight: '600',
                                        fontSize: '13px'
                                    }}>
                                        Facebook
                                    </button>
                                    <button style={{
                                        padding: '8px 12px',
                                        background: '#1da1f2',
                                        color: 'white',
                                        border: 'none',
                                        borderRadius: '6px',
                                        cursor: 'pointer',
                                        fontWeight: '600',
                                        fontSize: '13px'
                                    }}>
                                        Twitter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                {/* Comments Section */}
                {post.approved_comments && post.approved_comments.length > 0 && (
                    <div style={{
                        background: 'white',
                        borderRadius: '15px',
                        padding: '40px 50px',
                        marginTop: '30px',
                        boxShadow: '0 2px 10px rgba(0,0,0,0.05)'
                    }}>
                        <h3 style={{
                            fontSize: '24px',
                            fontWeight: '700',
                            marginBottom: '30px',
                            color: '#1a1a2e',
                            paddingBottom: '20px',
                            borderBottom: '2px solid #f3f4f6'
                        }}>
                            Bình luận ({post.approved_comments.length})
                        </h3>

                        <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                            {post.approved_comments.map(comment => (
                                <div key={comment.id} style={{
                                    padding: '20px',
                                    background: '#f9fafb',
                                    borderRadius: '10px',
                                    borderLeft: '3px solid #ff4500'
                                }}>
                                    <div style={{
                                        display: 'flex',
                                        justifyContent: 'space-between',
                                        marginBottom: '12px'
                                    }}>
                                        <strong style={{ color: '#1a1a2e', fontSize: '15px' }}>
                                            {comment.author_display_name}
                                        </strong>
                                        <span style={{ fontSize: '13px', color: '#6b7280' }}>
                                            {formatDate(comment.created_at)}
                                        </span>
                                    </div>
                                    <p style={{
                                        color: '#374151',
                                        lineHeight: '1.6',
                                        margin: 0
                                    }}>
                                        {comment.content}
                                    </p>
                                </div>
                            ))}
                        </div>
                    </div>
                )}
            </div>

            <style>{`
                .blog-content h1,
                .blog-content h2,
                .blog-content h3 {
                    color: #1a1a2e;
                    font-weight: 700;
                    margin-top: 35px;
                    margin-bottom: 18px;
                    line-height: 1.3;
                }

                .blog-content h1 { font-size: 32px; }
                .blog-content h2 { font-size: 28px; }
                .blog-content h3 { font-size: 24px; }

                .blog-content p {
                    margin-bottom: 20px;
                }

                .blog-content ul,
                .blog-content ol {
                    margin-bottom: 20px;
                    padding-left: 30px;
                }

                .blog-content li {
                    margin-bottom: 12px;
                    line-height: 1.8;
                }

                .blog-content img {
                    max-width: 100%;
                    height: auto;
                    border-radius: 10px;
                    margin: 30px 0;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                }

                .blog-content a {
                    color: #ff4500;
                    font-weight: 600;
                    text-decoration: none;
                    border-bottom: 2px solid transparent;
                    transition: all 0.2s;
                }

                .blog-content a:hover {
                    border-bottom-color: #ff4500;
                }

                .blog-content blockquote {
                    margin: 30px 0;
                    padding: 20px 25px;
                    background: #f9fafb;
                    border-left: 4px solid #ff4500;
                    font-style: italic;
                    color: #4b5563;
                }

                .blog-content code {
                    background: #f3f4f6;
                    padding: 3px 8px;
                    border-radius: 4px;
                    font-family: 'Courier New', monospace;
                    font-size: 14px;
                    color: #d63384;
                }

                .blog-content pre {
                    background: #1a1a2e;
                    color: #f8f8f2;
                    padding: 20px;
                    border-radius: 10px;
                    overflow-x: auto;
                    margin: 25px 0;
                }

                .blog-content pre code {
                    background: transparent;
                    padding: 0;
                    color: #f8f8f2;
                }

                .blog-content table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 25px 0;
                }

                .blog-content table th,
                .blog-content table td {
                    padding: 12px;
                    border: 1px solid #e5e7eb;
                    text-align: left;
                }

                .blog-content table th {
                    background: #f9fafb;
                    font-weight: 600;
                    color: #1a1a2e;
                }

                .blog-content table tr:hover {
                    background: #f9fafb;
                }
            `}</style>
        </div>
        </Layout>
    );
}

export default BlogDetail;
