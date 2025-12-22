import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

function BlogSection() {
    const [posts, setPosts] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchLatestPosts();
    }, []);

    const fetchLatestPosts = async () => {
        setLoading(true);
        try {
            const response = await axios.get('/api/blogs', {
                params: {
                    page: 1,
                    per_page: 6  // Hiển thị 6 bài mới nhất
                }
            });
            setPosts(response.data.data);
        } catch (error) {
            console.error('Error fetching posts:', error);
        } finally {
            setLoading(false);
        }
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

    const getFirstLetter = (text) => {
        return text ? text.charAt(0).toUpperCase() : 'B';
    };

    return (
        <section style={{ 
            padding: '80px 20px', 
            background: '#f9fafb' 
        }}>
            <div style={{ maxWidth: '1200px', margin: '0 auto' }}>
                {/* Section Header */}
                <div style={{ textAlign: 'center', marginBottom: '60px' }}>
                    <span style={{
                        fontSize: '14px',
                        fontWeight: '600',
                        color: '#ff4500',
                        textTransform: 'uppercase',
                        letterSpacing: '2px'
                    }}>
                        LATEST UPDATES
                    </span>
                    <h2 style={{
                        fontSize: '42px',
                        fontWeight: '700',
                        color: '#1f2937',
                        margin: '15px 0',
                        lineHeight: '1.2'
                    }}>
                        Sunny Auto News
                    </h2>
                    <p style={{
                        fontSize: '18px',
                        color: '#6b7280',
                        maxWidth: '600px',
                        margin: '0 auto'
                    }}>
                        Sunny Auto continues to push boundaries and bring you the latest innovations.
                    </p>
                    
                    {/* View All News Button */}
                    <Link 
                        to="/blog"
                        style={{
                            display: 'inline-flex',
                            alignItems: 'center',
                            gap: '8px',
                            marginTop: '30px',
                            padding: '12px 24px',
                            background: 'transparent',
                            border: '2px solid #ff4500',
                            borderRadius: '50px',
                            color: '#ff4500',
                            textDecoration: 'none',
                            fontWeight: '600',
                            fontSize: '16px',
                            transition: 'all 0.3s ease',
                            cursor: 'pointer'
                        }}
                        onMouseEnter={(e) => {
                            e.target.style.background = '#ff4500';
                            e.target.style.color = 'white';
                            e.target.style.transform = 'translateY(-2px)';
                        }}
                        onMouseLeave={(e) => {
                            e.target.style.background = 'transparent';
                            e.target.style.color = '#ff4500';
                            e.target.style.transform = 'translateY(0)';
                        }}
                    >
                        View All News
                        <span style={{ fontSize: '18px' }}>→</span>
                    </Link>
                </div>

                {/* Loading State */}
                {loading ? (
                    <div style={{
                        display: 'flex',
                        justifyContent: 'center',
                        alignItems: 'center',
                        minHeight: '400px'
                    }}>
                        <div style={{
                            width: '40px',
                            height: '40px',
                            border: '4px solid #f3f4f6',
                            borderTop: '4px solid #ff4500',
                            borderRadius: '50%',
                            animation: 'spin 1s linear infinite'
                        }}></div>
                    </div>
                ) : (
                    <>
                        {/* Blog Grid */}
                        <div style={{
                            display: 'flex',
                            flexWrap: 'wrap',
                            gap: '30px',
                            marginBottom: '50px',
                            justifyContent: 'center'
                        }}>
                            {posts.map((post, index) => (
                                <article
                                    key={post.id}
                                    style={{
                                        background: 'white',
                                        borderRadius: '16px',
                                        overflow: 'hidden',
                                        boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
                                        transition: 'all 0.3s ease',
                                        cursor: 'pointer',
                                        flex: '0 0 auto',
                                        width: '100%',
                                        maxWidth: '380px'
                                    }}
                                    onMouseEnter={(e) => {
                                        e.currentTarget.style.transform = 'translateY(-8px)';
                                        e.currentTarget.style.boxShadow = '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';
                                    }}
                                    onMouseLeave={(e) => {
                                        e.currentTarget.style.transform = 'translateY(0)';
                                        e.currentTarget.style.boxShadow = '0 4px 6px -1px rgba(0, 0, 0, 0.1)';
                                    }}
                                >
                                    <Link 
                                        to={`/blog/${post.slug}`}
                                        style={{ textDecoration: 'none', color: 'inherit' }}
                                    >
                                        {/* Blog Image */}
                                        <div style={{ 
                                            height: '240px', 
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
                                                        transition: 'transform 0.3s ease'
                                                    }}
                                                    onError={(e) => {
                                                        e.target.style.display = 'none';
                                                        const placeholderDiv = document.createElement('div');
                                                        placeholderDiv.style.cssText = `
                                                            position: absolute;
                                                            top: 0;
                                                            left: 0;
                                                            width: 100%;
                                                            height: 100%;
                                                            background: linear-gradient(135deg, #ff4500 0%, #ff6b35 100%);
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                            color: white;
                                                            font-size: 48px;
                                                            font-weight: bold;
                                                        `;
                                                        placeholderDiv.textContent = getFirstLetter(post.title);
                                                        e.target.parentNode.appendChild(placeholderDiv);
                                                    }}
                                                    onMouseEnter={(e) => {
                                                        e.target.style.transform = 'scale(1.1)';
                                                    }}
                                                    onMouseLeave={(e) => {
                                                        e.target.style.transform = 'scale(1)';
                                                    }}
                                                />
                                            ) : (
                                                <div style={{
                                                    width: '100%',
                                                    height: '100%',
                                                    background: 'linear-gradient(135deg, #ff4500 0%, #ff6b35 100%)',
                                                    display: 'flex',
                                                    alignItems: 'center',
                                                    justifyContent: 'center',
                                                    color: 'white',
                                                    fontSize: '48px',
                                                    fontWeight: 'bold'
                                                }}>
                                                    {getFirstLetter(post.title)}
                                                </div>
                                            )}
                                        </div>

                                        {/* Blog Content */}
                                        <div style={{ padding: '30px' }}>
                                            {/* Category */}
                                            {post.category && (
                                                <span style={{
                                                    display: 'inline-block',
                                                    fontSize: '12px',
                                                    fontWeight: '600',
                                                    color: '#ff4500',
                                                    background: 'rgba(255, 69, 0, 0.1)',
                                                    padding: '4px 12px',
                                                    borderRadius: '20px',
                                                    marginBottom: '15px'
                                                }}>
                                                    {post.category.name}
                                                </span>
                                            )}

                                            {/* Title */}
                                            <h3 style={{
                                                fontSize: '20px',
                                                fontWeight: '700',
                                                color: '#1f2937',
                                                marginBottom: '12px',
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
                                                fontSize: '16px',
                                                color: '#6b7280',
                                                lineHeight: '1.6',
                                                marginBottom: '20px',
                                                display: '-webkit-box',
                                                WebkitLineClamp: '3',
                                                WebkitBoxOrient: 'vertical',
                                                overflow: 'hidden'
                                            }}>
                                                {stripHtml(post.content)}
                                            </p>

                                            {/* Meta */}
                                            <div style={{
                                                display: 'flex',
                                                alignItems: 'center',
                                                justifyContent: 'space-between',
                                                fontSize: '14px',
                                                color: '#9ca3af'
                                            }}>
                                                <span>
                                                    📅 {formatDate(post.published_at || post.created_at)}
                                                </span>
                                                <span>
                                                    ⏱️ 3 min read
                                                </span>
                                            </div>

                                            {/* Read More */}
                                            <div style={{
                                                marginTop: '20px',
                                                display: 'flex',
                                                alignItems: 'center',
                                                gap: '8px',
                                                color: '#ff4500',
                                                fontWeight: '600',
                                                fontSize: '16px'
                                            }}>
                                                Read more
                                                <span style={{
                                                    transition: 'transform 0.2s ease'
                                                }}>→</span>
                                            </div>
                                        </div>
                                    </Link>
                                </article>
                            ))}
                        </div>

                        {/* No Posts Message */}
                        {posts.length === 0 && (
                            <div style={{
                                textAlign: 'center',
                                padding: '60px 20px',
                                color: '#6b7280'
                            }}>
                                <div style={{
                                    fontSize: '48px',
                                    marginBottom: '20px'
                                }}>
                                    📝
                                </div>
                                <h3 style={{
                                    fontSize: '24px',
                                    fontWeight: '600',
                                    marginBottom: '10px',
                                    color: '#374151'
                                }}>
                                    Chưa có bài viết nào
                                </h3>
                                <p style={{
                                    fontSize: '16px'
                                }}>
                                    Chúng tôi đang chuẩn bị nội dung mới. Vui lòng quay lại sau!
                                </p>
                            </div>
                        )}
                    </>
                )}
            </div>

            <style>{`
                @keyframes spin {
                    to { transform: rotate(360deg); }
                }
            `}</style>
        </section>
    );
}

export default BlogSection;