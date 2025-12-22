import React from 'react';

function Footer() {
    return (
        <footer style={{
            background: 'white',
            borderTop: '1px solid #e5e7eb',
            padding: '60px 20px 30px',
            marginTop: '80px'
        }}>
            <div style={{ maxWidth: '1200px', margin: '0 auto' }}>
                {/* Main Footer Content */}
                <div style={{
                    display: 'grid',
                    gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))',
                    gap: '60px',
                    marginBottom: '50px'
                }}>
                    {/* Company Info */}
                    <div>
                        <div style={{ marginBottom: '20px' }}>
                            <img 
                                src="/imgs/logo/logo.png" 
                                alt="Sunny Auto"
                                style={{ height: '40px', marginBottom: '15px' }}
                                onError={(e) => {
                                    e.target.style.display = 'none';
                                }}
                            />
                        </div>
                        <p style={{
                            fontSize: '15px',
                            lineHeight: '1.7',
                            color: '#6b7280',
                            marginBottom: '25px',
                            maxWidth: '320px'
                        }}>
                            Sunny Auto – Distributor of high-quality electric trucks from China, driving sustainable transportation forward.
                        </p>
                        
                        {/* Social Links */}
                        <div style={{ display: 'flex', gap: '12px' }}>
                            <a
                                href="https://leonglee.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                style={{
                                    width: '40px',
                                    height: '40px',
                                    background: 'white',
                                    border: '1px solid #e5e7eb',
                                    borderRadius: '50%',
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    textDecoration: 'none',
                                    transition: 'all 0.2s ease',
                                    cursor: 'pointer'
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.borderColor = '#ff4500';
                                    e.currentTarget.style.background = '#fff5f0';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.borderColor = '#e5e7eb';
                                    e.currentTarget.style.background = 'white';
                                }}
                                aria-label="Facebook"
                            >
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="#374151">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            
                            <a
                                href="https://leonglee.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                style={{
                                    width: '40px',
                                    height: '40px',
                                    background: 'white',
                                    border: '1px solid #e5e7eb',
                                    borderRadius: '50%',
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    textDecoration: 'none',
                                    transition: 'all 0.2s ease',
                                    cursor: 'pointer'
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.borderColor = '#ff4500';
                                    e.currentTarget.style.background = '#fff5f0';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.borderColor = '#e5e7eb';
                                    e.currentTarget.style.background = 'white';
                                }}
                                aria-label="Instagram"
                            >
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="#374151">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            
                            <a
                                href="https://leonglee.com"
                                target="_blank"
                                rel="noopener noreferrer"
                                style={{
                                    width: '40px',
                                    height: '40px',
                                    background: 'white',
                                    border: '1px solid #e5e7eb',
                                    borderRadius: '50%',
                                    display: 'flex',
                                    alignItems: 'center',
                                    justifyContent: 'center',
                                    textDecoration: 'none',
                                    transition: 'all 0.2s ease',
                                    cursor: 'pointer'
                                }}
                                onMouseEnter={(e) => {
                                    e.currentTarget.style.borderColor = '#ff4500';
                                    e.currentTarget.style.background = '#fff5f0';
                                }}
                                onMouseLeave={(e) => {
                                    e.currentTarget.style.borderColor = '#e5e7eb';
                                    e.currentTarget.style.background = 'white';
                                }}
                                aria-label="Phone"
                            >
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="#374151">
                                    <path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56-.35-.12-.74-.03-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/>
                                </svg>
                            </a>
                        </div>
                    </div>

                    {/* Support */}
                    <div>
                        <h4 style={{
                            fontSize: '16px',
                            fontWeight: '600',
                            marginBottom: '20px',
                            color: '#111827'
                        }}>
                            Support
                        </h4>
                        <div style={{ fontSize: '15px', lineHeight: '1.8', color: '#6b7280' }}>
                            <p style={{ margin: '0 0 5px 0', fontWeight: '600', color: '#374151' }}>
                                HQ - Hanoi:
                            </p>
                            <p style={{ margin: '0 0 5px 0' }}>
                                Room 801, Floor 8, West 1 Tower,
                            </p>
                            <p style={{ margin: '0 0 5px 0' }}>
                                Vinhomes West Point, HH Land Plot,
                            </p>
                            <p style={{ margin: '0 0 15px 0' }}>
                                Pham Hung Street, Tu Liem Ward, Hanoi
                            </p>
                            <p style={{ margin: '0 0 5px 0', fontWeight: '600', color: '#374151' }}>
                                Office - HCMC:
                            </p>
                            <p style={{ margin: '0 0 5px 0' }}>
                                Level 17, Victory Tower,
                            </p>
                            <p style={{ margin: '0 0 20px 0' }}>
                                12 Tan Trao Street, Tan My Ward, HCMC
                            </p>
                            <p style={{ margin: '0 0 8px 0' }}>
                                <a 
                                    href="mailto:sales@sunnyauto.vn"
                                    style={{
                                        color: '#6b7280',
                                        textDecoration: 'none',
                                        transition: 'color 0.2s'
                                    }}
                                    onMouseEnter={(e) => e.target.style.color = '#ff4500'}
                                    onMouseLeave={(e) => e.target.style.color = '#6b7280'}
                                >
                                    sales@sunnyauto.vn
                                </a>
                            </p>
                            <p style={{ margin: '0' }}>
                                <a 
                                    href="tel:+842854119449"
                                    style={{
                                        color: '#6b7280',
                                        textDecoration: 'none',
                                        transition: 'color 0.2s'
                                    }}
                                    onMouseEnter={(e) => e.target.style.color = '#ff4500'}
                                    onMouseLeave={(e) => e.target.style.color = '#6b7280'}
                                >
                                    +84 28 5411 9449
                                </a>
                            </p>
                        </div>
                    </div>

                    {/* Legal */}
                    <div>
                        <h4 style={{
                            fontSize: '16px',
                            fontWeight: '600',
                            marginBottom: '20px',
                            color: '#111827'
                        }}>
                            Legal
                        </h4>
                        <div style={{ fontSize: '15px', lineHeight: '2', color: '#6b7280' }}>
                            <p style={{ margin: '0 0 10px 0' }}>
                                <a 
                                    href="/contact"
                                    style={{
                                        color: '#6b7280',
                                        textDecoration: 'none',
                                        transition: 'color 0.2s'
                                    }}
                                    onMouseEnter={(e) => e.target.style.color = '#ff4500'}
                                    onMouseLeave={(e) => e.target.style.color = '#6b7280'}
                                >
                                    Contact
                                </a>
                            </p>
                            <p style={{ margin: '0' }}>
                                <a 
                                    href="/about"
                                    style={{
                                        color: '#6b7280',
                                        textDecoration: 'none',
                                        transition: 'color 0.2s'
                                    }}
                                    onMouseEnter={(e) => e.target.style.color = '#ff4500'}
                                    onMouseLeave={(e) => e.target.style.color = '#6b7280'}
                                >
                                    About
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                {/* Bottom Bar */}
                <div style={{
                    borderTop: '1px solid #e5e7eb',
                    paddingTop: '25px',
                    display: 'flex',
                    flexWrap: 'wrap',
                    justifyContent: 'space-between',
                    alignItems: 'center',
                    gap: '15px',
                    fontSize: '14px',
                    color: '#6b7280'
                }}>
                    <p style={{ margin: '0' }}>
                        © 2025 Sunny Auto EV Motors. All rights reserved.
                    </p>
                    
                    <div style={{
                        display: 'flex',
                        gap: '20px',
                        flexWrap: 'wrap'
                    }}>
                        <a 
                            href="/privacy-policy"
                            style={{
                                color: '#6b7280',
                                textDecoration: 'none',
                                transition: 'color 0.2s'
                            }}
                            onMouseEnter={(e) => e.target.style.color = '#ff4500'}
                            onMouseLeave={(e) => e.target.style.color = '#6b7280'}
                        >
                            Privacy Policy
                        </a>
                        <span style={{ color: '#d1d5db' }}>|</span>
                        <a 
                            href="/cookie-policy"
                            style={{
                                color: '#6b7280',
                                textDecoration: 'none',
                                transition: 'color 0.2s'
                            }}
                            onMouseEnter={(e) => e.target.style.color = '#ff4500'}
                            onMouseLeave={(e) => e.target.style.color = '#6b7280'}
                        >
                            Cookie Policy
                        </a>
                        <span style={{ color: '#d1d5db' }}>|</span>
                        <span>
                            Leong Lee International Limited (LLI)
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    );
}

export default Footer;