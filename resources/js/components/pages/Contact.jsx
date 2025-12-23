import React, { useState, useEffect, useRef } from 'react';
import { useLocation } from 'react-router-dom';
import Layout from '../layout/Layout';
import axios from 'axios';

function Contact() {
    const location = useLocation();
    const formRef = useRef(null);
        // Scroll đến form nếu được yêu cầu từ ProductDetail
        useEffect(() => {
            if (location.state && location.state.scrollToForm && formRef.current) {
                setTimeout(() => {
                    formRef.current.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 300);
            }
        }, [location]);
    const [formData, setFormData] = useState({
        name: '',
        company: '',
        email: '',
        phone: '',
        subject: '',         // Thêm subject
        message: '',         // Thêm message
        location: '',
        inquiry_types: [],
        ev_products: [],
        ev_products_other: '',
        charging_products: [],
        charging_products_other: '',
        intended_use: '',
        intended_use_other: '',
        estimated_budget: '',
        purchase_timeline: '',
        notes: '',
        consent_agreed: false
    });

    const [isSubmitting, setIsSubmitting] = useState(false);
    const [submitStatus, setSubmitStatus] = useState(null);
    const [errorMessage, setErrorMessage] = useState('');
    const [errors, setErrors] = useState({});

    const vietnamProvinces = [
        'Hà Nội', 'Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ',
        'An Giang', 'Bà Rịa - Vũng Tàu', 'Bắc Giang', 'Bắc Kạn', 'Bạc Liêu',
        'Bắc Ninh', 'Bến Tre', 'Bình Định', 'Bình Dương', 'Bình Phước',
        'Bình Thuận', 'Cà Mau', 'Cao Bằng', 'Đắk Lắk', 'Đắk Nông',
        'Điện Biên', 'Đồng Nai', 'Đồng Tháp', 'Gia Lai', 'Hà Giang',
        'Hà Nam', 'Hà Tĩnh', 'Hải Dương', 'Hậu Giang', 'Hòa Bình',
        'Hưng Yên', 'Khánh Hòa', 'Kiên Giang', 'Kon Tum', 'Lai Châu',
        'Lâm Đồng', 'Lạng Sơn', 'Lào Cai', 'Long An', 'Nam Định',
        'Nghệ An', 'Ninh Bình', 'Ninh Thuận', 'Phú Thọ', 'Phú Yên',
        'Quảng Bình', 'Quảng Nam', 'Quảng Ngãi', 'Quảng Ninh', 'Quảng Trị',
        'Sóc Trăng', 'Sơn La', 'Tây Ninh', 'Thái Bình', 'Thái Nguyên',
        'Thanh Hóa', 'Thừa Thiên Huế', 'Tiền Giang', 'Trà Vinh', 'Tuyên Quang',
        'Vĩnh Long', 'Vĩnh Phúc', 'Yên Bái'
    ];

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
        if (errors[name]) {
            setErrors(prev => ({ ...prev, [name]: '' }));
        }
    };

    const handleCheckboxChange = (name, value) => {
        setFormData(prev => {
            const current = prev[name] || [];
            const updated = current.includes(value)
                ? current.filter(item => item !== value)
                : [...current, value];
            return { ...prev, [name]: updated };
        });
        if (errors[name]) {
            setErrors(prev => ({ ...prev, [name]: '' }));
        }
    };

    const handleRadioChange = (name, value) => {
        setFormData(prev => ({ ...prev, [name]: value }));
        if (errors[name]) {
            setErrors(prev => ({ ...prev, [name]: '' }));
        }
    };

    const validateForm = () => {
        const newErrors = {};
        if (!formData.name.trim()) newErrors.name = 'Vui lòng nhập họ tên';
        if (!formData.email.trim()) newErrors.email = 'Vui lòng nhập email';
        if (!formData.phone.trim()) newErrors.phone = 'Vui lòng nhập số điện thoại';
        if (!formData.inquiry_types.length) newErrors.inquiry_types = 'Vui lòng chọn ít nhất một loại yêu cầu';
        if (!formData.intended_use) newErrors.intended_use = 'Vui lòng chọn mục đích sử dụng';
        if (!formData.consent_agreed) newErrors.consent_agreed = 'Vui lòng đồng ý với điều khoản';
        
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        
        if (!validateForm()) {
            return;
        }

        setIsSubmitting(true);
        setErrorMessage('');
        
        try {
            const response = await axios.post('/api/contact', formData);
            
            setSubmitStatus('success');
            setFormData({
                name: '',
                company: '',
                email: '',
                phone: '',
                subject: '',
                message: '',
                location: '',
                inquiry_types: [],
                ev_products: [],
                ev_products_other: '',
                charging_products: [],
                charging_products_other: '',
                intended_use: '',
                intended_use_other: '',
                estimated_budget: '',
                purchase_timeline: '',
                notes: '',
                consent_agreed: false
            });
            
            setTimeout(() => setSubmitStatus(null), 5000);
        } catch (error) {
            console.error('Error submitting contact form:', error);
            setSubmitStatus('error');
            setErrorMessage(error.response?.data?.message || 'Đã có lỗi xảy ra. Vui lòng thử lại sau.');
            
            setTimeout(() => {
                setSubmitStatus(null);
                setErrorMessage('');
            }, 5000);
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <Layout>
            {/* Hero Section */}
            <div style={{
                position: 'relative',
                height: '400px',
                backgroundImage: 'url(/imgs/products/contact.jpg)',
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'center'
            }}>
                <div style={{
                    position: 'absolute',
                    inset: 0,
                    background: 'rgba(0, 0, 0, 0.5)'
                }}></div>
                <div style={{
                    position: 'relative',
                    zIndex: 2,
                    textAlign: 'center',
                    color: 'white',
                    maxWidth: '800px',
                    padding: '0 20px'
                }}>
                    <h1 style={{ fontSize: '48px', fontWeight: '700', marginBottom: '20px' }}>
                        Liên hệ với chúng tôi
                    </h1>
                    <p style={{ fontSize: '20px', lineHeight: '1.6', opacity: '0.95' }}>
                        Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn
                    </p>
                </div>
            </div>

            {/* Contact Info & Map Section */}
            <div style={{ padding: '80px 20px', background: '#fff' }}>
                <div style={{ maxWidth: '1200px', margin: '0 auto' }}>
                    <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(350px, 1fr))', gap: '40px', marginBottom: '60px' }}>
                        {/* Contact Information */}
                        <div>
                            <h2 style={{ fontSize: '28px', fontWeight: '700', marginBottom: '24px', color: '#1e293b' }}>
                                Thông tin liên hệ
                            </h2>
                            <div style={{ display: 'flex', flexDirection: 'column', gap: '20px' }}>
                                <div style={{ display: 'flex', gap: '16px', alignItems: 'flex-start' }}>
                                    <div style={{
                                        width: '48px',
                                        height: '48px',
                                        background: '#dbeafe',
                                        borderRadius: '12px',
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center',
                                        flexShrink: 0
                                    }}>
                                        <svg width="24" height="24" fill="#2563eb" viewBox="0 0 24 24">
                                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 style={{ fontSize: '16px', fontWeight: '600', color: '#1e293b', marginBottom: '4px' }}>Địa chỉ</h3>
                                        <p style={{ fontSize: '14px', color: '#64748b', lineHeight: '1.6' }}>
                                            Victory Tower, Tân Chánh Hiệp, Quận 12, Hồ Chí Minh
                                        </p>
                                    </div>
                                </div>

                                <div style={{ display: 'flex', gap: '16px', alignItems: 'flex-start' }}>
                                    <div style={{
                                        width: '48px',
                                        height: '48px',
                                        background: '#dcfce7',
                                        borderRadius: '12px',
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center',
                                        flexShrink: 0
                                    }}>
                                        <svg width="24" height="24" fill="#ea580c" viewBox="0 0 24 24">
                                            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 style={{ fontSize: '16px', fontWeight: '600', color: '#1e293b', marginBottom: '4px' }}>Điện thoại</h3>
                                        <p style={{ fontSize: '14px', color: '#64748b', lineHeight: '1.6' }}>
                                            <a href="tel:+84123456789" style={{ color: '#ea580c', textDecoration: 'none' }}>+84 123 456 789</a>
                                        </p>
                                    </div>
                                </div>

                                <div style={{ display: 'flex', gap: '16px', alignItems: 'flex-start' }}>
                                    <div style={{
                                        width: '48px',
                                        height: '48px',
                                        background: '#fef3c7',
                                        borderRadius: '12px',
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center',
                                        flexShrink: 0
                                    }}>
                                        <svg width="24" height="24" fill="#f59e0b" viewBox="0 0 24 24">
                                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 style={{ fontSize: '16px', fontWeight: '600', color: '#1e293b', marginBottom: '4px' }}>Email</h3>
                                        <p style={{ fontSize: '14px', color: '#64748b', lineHeight: '1.6' }}>
                                            <a href="mailto:contact@sunnyauto.vn" style={{ color: '#f59e0b', textDecoration: 'none' }}>contact@sunnyauto.vn</a>
                                        </p>
                                    </div>
                                </div>

                                <div style={{ display: 'flex', gap: '16px', alignItems: 'flex-start' }}>
                                    <div style={{
                                        width: '48px',
                                        height: '48px',
                                        background: '#e0f2fe',
                                        borderRadius: '12px',
                                        display: 'flex',
                                        alignItems: 'center',
                                        justifyContent: 'center',
                                        flexShrink: 0
                                    }}>
                                        <svg width="24" height="24" fill="#0284c7" viewBox="0 0 24 24">
                                            <path d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 style={{ fontSize: '16px', fontWeight: '600', color: '#1e293b', marginBottom: '4px' }}>Giờ làm việc</h3>
                                        <p style={{ fontSize: '14px', color: '#64748b', lineHeight: '1.6' }}>
                                            Thứ 2 - Thứ 6: 8:00 - 17:00<br />
                                            Thứ 7: 8:00 - 12:00
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Google Map */}
                        <div>
                            <h2 style={{ fontSize: '28px', fontWeight: '700', marginBottom: '24px', color: '#1e293b' }}>
                                Bản đồ
                            </h2>
                            <div style={{ 
                                borderRadius: '16px', 
                                overflow: 'hidden',
                                boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
                                height: '400px'
                            }}>
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3920.0674732454604!2d106.71854507812573!3d10.729279362128127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175250070b5c6a7%3A0x49838e03e122ba5!2sVictory%20Tower!5e0!3m2!1svi!2s!4v1766048157087!5m2!1svi!2s" 
                                    width="100%" 
                                    height="100%" 
                                    style={{ border: 0 }} 
                                    allowFullScreen="" 
                                    loading="lazy" 
                                    referrerPolicy="no-referrer-when-downgrade"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Form Section */}
            <div style={{ padding: '80px 20px', background: '#f9fafb' }}>
                <div style={{ maxWidth: '900px', margin: '0 auto' }}>
                    <form ref={formRef} onSubmit={handleSubmit} style={{
                        background: 'white',
                        padding: '40px',
                        borderRadius: '16px',
                        boxShadow: '0 4px 6px -1px rgba(0, 0, 0, 0.1)'
                    }}>
                        {/* Success/Error Messages */}
                        {submitStatus === 'success' && (
                            <div style={{
                                padding: '16px',
                                marginBottom: '24px',
                                background: '#dcfce7',
                                border: '1px solid #86efac',
                                borderRadius: '8px',
                                color: '#15803d'
                            }}>
                                ✓ Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.
                            </div>
                        )}
                        
                        {submitStatus === 'error' && (
                            <div style={{
                                padding: '16px',
                                marginBottom: '24px',
                                background: '#fee2e2',
                                border: '1px solid #fca5a5',
                                borderRadius: '8px',
                                color: '#dc2626'
                            }}>
                                ✗ {errorMessage}
                            </div>
                        )}

                        {/* 1. Contact Information */}
                        <section style={{ marginBottom: '32px' }}>
                            <h2 style={{ fontSize: '20px', fontWeight: '700', marginBottom: '20px', color: '#1e293b' }}>
                                1. Thông tin liên hệ
                            </h2>
                            
                            <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px' }}>
                                <div style={{ gridColumn: '1 / -1' }}>
                                    <label style={labelStyle}>
                                        Họ và tên <span style={{ color: '#dc2626' }}>*</span>
                                    </label>
                                    <input
                                        type="text"
                                        name="name"
                                        value={formData.name}
                                        onChange={handleChange}
                                        style={{ ...inputStyle, borderColor: errors.name ? '#dc2626' : '#e2e8f0' }}
                                        placeholder="Nguyễn Văn A"
                                    />
                                    {errors.name && <span style={errorStyle}>{errors.name}</span>}
                                </div>

                                <div style={{ gridColumn: '1 / -1' }}>
                                    <label style={labelStyle}>Công ty / Tổ chức</label>
                                    <input
                                        type="text"
                                        name="company"
                                        value={formData.company}
                                        onChange={handleChange}
                                        style={inputStyle}
                                        placeholder="Tên công ty (nếu có)"
                                    />
                                </div>

                                <div>
                                    <label style={labelStyle}>
                                        Số điện thoại <span style={{ color: '#dc2626' }}>*</span>
                                    </label>
                                    <input
                                        type="tel"
                                        name="phone"
                                        value={formData.phone}
                                        onChange={handleChange}
                                        style={{ ...inputStyle, borderColor: errors.phone ? '#dc2626' : '#e2e8f0' }}
                                        placeholder="0901234567"
                                    />
                                    {errors.phone && <span style={errorStyle}>{errors.phone}</span>}
                                </div>

                                <div>
                                    <label style={labelStyle}>
                                        Email <span style={{ color: '#dc2626' }}>*</span>
                                    </label>
                                    <input
                                        type="email"
                                        name="email"
                                        value={formData.email}
                                        onChange={handleChange}
                                        style={{ ...inputStyle, borderColor: errors.email ? '#dc2626' : '#e2e8f0' }}
                                        placeholder="email@example.com"
                                    />
                                    {errors.email && <span style={errorStyle}>{errors.email}</span>}
                                </div>

                                <div style={{ gridColumn: '1 / -1' }}>
                                    <label style={labelStyle}>Tỉnh / Thành phố</label>
                                    <select
                                        name="location"
                                        value={formData.location}
                                        onChange={handleChange}
                                        style={inputStyle}
                                    >
                                        <option value="">-- Chọn tỉnh/thành phố --</option>
                                        {vietnamProvinces.map(province => (
                                            <option key={province} value={province}>{province}</option>
                                        ))}
                                    </select>
                                </div>
                            </div>
                        </section>

                        {/* 2. Subject & Message */}
                        <section style={{ marginBottom: '32px' }}>
                            <h2 style={{ fontSize: '20px', fontWeight: '700', marginBottom: '20px', color: '#1e293b' }}>
                                2. Chủ đề & Tin nhắn
                            </h2>
                            
                            <div style={{ marginBottom: '16px' }}>
                                <label style={labelStyle}>Chủ đề liên hệ</label>
                                <input
                                    type="text"
                                    name="subject"
                                    value={formData.subject}
                                    onChange={handleChange}
                                    style={inputStyle}
                                    placeholder="VD: Hỏi giá xe điện BYD, Tư vấn trạm sạc cho công ty..."
                                />
                                <p style={{ fontSize: '12px', color: '#64748b', marginTop: '4px' }}>
                                    Tóm tắt ngắn gọn nội dung bạn muốn trao đổi
                                </p>
                            </div>

                            <div>
                                <label style={labelStyle}>Nội dung tin nhắn</label>
                                <textarea
                                    name="message"
                                    value={formData.message}
                                    onChange={handleChange}
                                    rows="4"
                                    style={inputStyle}
                                    placeholder="Mô tả chi tiết về nhu cầu, câu hỏi của bạn..."
                                />
                                <p style={{ fontSize: '12px', color: '#64748b', marginTop: '4px' }}>
                                    Chia sẻ thêm thông tin để chúng tôi hỗ trợ bạn tốt hơn
                                </p>
                            </div>
                        </section>

                        {/* 3. Inquiry Type */}
                        <section style={{ marginBottom: '32px' }}>
                            <h2 style={{ fontSize: '20px', fontWeight: '700', marginBottom: '20px', color: '#1e293b' }}>
                                3. Loại yêu cầu <span style={{ color: '#dc2626' }}>*</span>
                            </h2>
                            <div style={{ display: 'grid', gap: '12px' }}>
                                {['Xe điện thương mại / xe tải điện', 'Giải pháp sạc', 'Báo giá', 'Hỗ trợ kỹ thuật / giải pháp vận hành'].map(option => (
                                    <label key={option} style={checkboxLabelStyle}>
                                        <input
                                            type="checkbox"
                                            checked={formData.inquiry_types.includes(option)}
                                            onChange={() => handleCheckboxChange('inquiry_types', option)}
                                            style={checkboxStyle}
                                        />
                                        {option}
                                    </label>
                                ))}
                            </div>
                            {errors.inquiry_types && <span style={errorStyle}>{errors.inquiry_types}</span>}
                        </section>

                        {/* 3. Product of Interest */}
                        <section style={{ marginBottom: '32px' }}>
                            <h2 style={{ fontSize: '20px', fontWeight: '700', marginBottom: '20px', color: '#1e293b' }}>
                                3. Sản phẩm quan tâm
                            </h2>
                            
                            <div style={{ marginBottom: '20px' }}>
                                <h3 style={{ fontSize: '16px', fontWeight: '600', marginBottom: '12px', color: '#475569' }}>
                                    Xe điện
                                </h3>
                                <div style={{ display: 'grid', gap: '12px' }}>
                                    {['Xe tải điện hạng nhẹ', 'Xe nâng điện', 'Xe đầu kéo điện', 'Xe buýt điện', 'Xe ben điện'].map(option => (
                                        <label key={option} style={checkboxLabelStyle}>
                                            <input
                                                type="checkbox"
                                                checked={formData.ev_products.includes(option)}
                                                onChange={() => handleCheckboxChange('ev_products', option)}
                                                style={checkboxStyle}
                                            />
                                            {option}
                                        </label>
                                    ))}
                                    <label style={checkboxLabelStyle}>
                                        <input
                                            type="checkbox"
                                            checked={formData.ev_products.includes('Khác')}
                                            onChange={() => handleCheckboxChange('ev_products', 'Khác')}
                                            style={checkboxStyle}
                                        />
                                        Khác
                                    </label>
                                    {formData.ev_products.includes('Khác') && (
                                        <input
                                            type="text"
                                            name="ev_products_other"
                                            value={formData.ev_products_other}
                                            onChange={handleChange}
                                            style={{ ...inputStyle, marginLeft: '28px' }}
                                            placeholder="Vui lòng ghi rõ..."
                                        />
                                    )}
                                </div>
                            </div>

                            <div>
                                <h3 style={{ fontSize: '16px', fontWeight: '600', marginBottom: '12px', color: '#475569' }}>
                                    Trạm sạc
                                </h3>
                                <div style={{ display: 'grid', gap: '12px' }}>
                                    {['Bộ sạc AC', 'Bộ sạc DC nhanh'].map(option => (
                                        <label key={option} style={checkboxLabelStyle}>
                                            <input
                                                type="checkbox"
                                                checked={formData.charging_products.includes(option)}
                                                onChange={() => handleCheckboxChange('charging_products', option)}
                                                style={checkboxStyle}
                                            />
                                            {option}
                                        </label>
                                    ))}
                                    <label style={checkboxLabelStyle}>
                                        <input
                                            type="checkbox"
                                            checked={formData.charging_products.includes('Khác')}
                                            onChange={() => handleCheckboxChange('charging_products', 'Khác')}
                                            style={checkboxStyle}
                                        />
                                        Khác
                                    </label>
                                    {formData.charging_products.includes('Khác') && (
                                        <input
                                            type="text"
                                            name="charging_products_other"
                                            value={formData.charging_products_other}
                                            onChange={handleChange}
                                            style={{ ...inputStyle, marginLeft: '28px' }}
                                            placeholder="Vui lòng ghi rõ..."
                                        />
                                    )}
                                </div>
                            </div>
                        </section>

                        {/* 4. Intended Use */}
                        <section style={{ marginBottom: '32px' }}>
                            <h2 style={{ fontSize: '20px', fontWeight: '700', marginBottom: '20px', color: '#1e293b' }}>
                                4. Mục đích sử dụng <span style={{ color: '#dc2626' }}>*</span>
                            </h2>
                            <div style={{ display: 'grid', gap: '12px' }}>
                                {[
                                    { value: 'b2c', label: 'Cá nhân (B2C)' },
                                    { value: 'b2b', label: 'Doanh nghiệp / Logistics (B2B)' },
                                    { value: 'project', label: 'Dự án / Đội xe' },
                                    { value: 'other', label: 'Khác' }
                                ].map(option => (
                                    <label key={option.value} style={checkboxLabelStyle}>
                                        <input
                                            type="radio"
                                            name="intended_use"
                                            value={option.value}
                                            checked={formData.intended_use === option.value}
                                            onChange={() => handleRadioChange('intended_use', option.value)}
                                            style={checkboxStyle}
                                        />
                                        {option.label}
                                    </label>
                                ))}
                            </div>
                            {formData.intended_use === 'other' && (
                                <input
                                    type="text"
                                    name="intended_use_other"
                                    value={formData.intended_use_other}
                                    onChange={handleChange}
                                    style={{ ...inputStyle, marginTop: '12px', marginLeft: '28px' }}
                                    placeholder="Vui lòng ghi rõ..."
                                />
                            )}
                            {errors.intended_use && <span style={errorStyle}>{errors.intended_use}</span>}
                        </section>

                        {/* 5. Purchase Plan */}
                        <section style={{ marginBottom: '32px' }}>
                            <h2 style={{ fontSize: '20px', fontWeight: '700', marginBottom: '20px', color: '#1e293b' }}>
                                5. Kế hoạch mua hàng
                            </h2>
                            
                            <div style={{ marginBottom: '16px' }}>
                                <label style={labelStyle}>Ngân sách ước tính</label>
                                <select
                                    name="estimated_budget"
                                    value={formData.estimated_budget}
                                    onChange={handleChange}
                                    style={inputStyle}
                                >
                                    <option value="">-- Chọn mức ngân sách --</option>
                                    <option value="under_500m">Dưới 500 triệu</option>
                                    <option value="500m_1b">500 triệu - 1 tỷ</option>
                                    <option value="1b_3b">1 tỷ - 3 tỷ</option>
                                    <option value="3b_5b">3 tỷ - 5 tỷ</option>
                                    <option value="over_5b">Trên 5 tỷ</option>
                                </select>
                            </div>

                            <div>
                                <label style={labelStyle}>Thời gian dự kiến mua</label>
                                <div style={{ display: 'grid', gap: '12px', marginTop: '8px' }}>
                                    {[
                                        { value: 'immediate', label: 'Ngay lập tức' },
                                        { value: '1_3_months', label: '1-3 tháng' },
                                        { value: '3_6_months', label: '3-6 tháng' },
                                        { value: 'over_6_months', label: 'Trên 6 tháng' }
                                    ].map(option => (
                                        <label key={option.value} style={checkboxLabelStyle}>
                                            <input
                                                type="radio"
                                                name="purchase_timeline"
                                                value={option.value}
                                                checked={formData.purchase_timeline === option.value}
                                                onChange={() => handleRadioChange('purchase_timeline', option.value)}
                                                style={checkboxStyle}
                                            />
                                            {option.label}
                                        </label>
                                    ))}
                                </div>
                            </div>
                        </section>

                        {/* 6. Additional Notes */}
                        <section style={{ marginBottom: '32px' }}>
                            <h2 style={{ fontSize: '20px', fontWeight: '700', marginBottom: '20px', color: '#1e293b' }}>
                                6. Ghi chú / Yêu cầu kỹ thuật
                            </h2>
                            <textarea
                                name="notes"
                                value={formData.notes}
                                onChange={handleChange}
                                rows="5"
                                style={inputStyle}
                                placeholder="Chia sẻ thêm về nhu cầu của bạn..."
                            />
                        </section>

                        {/* 7. Consent */}
                        <section style={{ marginBottom: '32px' }}>
                            <label style={{ ...checkboxLabelStyle, alignItems: 'flex-start' }}>
                                <input
                                    type="checkbox"
                                    checked={formData.consent_agreed}
                                    onChange={(e) => setFormData(prev => ({ ...prev, consent_agreed: e.target.checked }))}
                                    style={{ ...checkboxStyle, marginTop: '4px' }}
                                />
                                <span>
                                    Tôi đồng ý với <a href="/privacy-policy" style={{ color: 'orangered' }}>chính sách bảo mật</a> và cho phép Sunny Auto liên hệ với tôi về sản phẩm và dịch vụ. <span style={{ color: '#dc2626' }}>*</span>
                                </span>
                            </label>
                            {errors.consent_agreed && <span style={errorStyle}>{errors.consent_agreed}</span>}
                        </section>

                        {/* Submit Button */}
                        <button
                            type="submit"
                            disabled={isSubmitting}
                            style={{
                                width: '100%',
                                padding: '16px',
                                background: isSubmitting 
                                    ? '#fb923c' 
                                    : 'linear-gradient(to right, #f97316, #ea580c)',
                                color: 'white',
                                fontSize: '16px',
                                fontWeight: '600',
                                border: 'none',
                                borderRadius: '8px',
                                cursor: isSubmitting ? 'not-allowed' : 'pointer',
                                transition: 'all 0.2s',
                                boxShadow: isSubmitting ? 'none' : '0 4px 6px -1px rgba(249, 115, 22, 0.3)'
                            }}
                            onMouseOver={(e) => !isSubmitting && (e.target.style.background = 'linear-gradient(to right, #ea580c, #c2410c)')}
                            onMouseOut={(e) => !isSubmitting && (e.target.style.background = 'linear-gradient(to right, #f97316, #ea580c)')}
                        >
                            {isSubmitting ? 'Đang gửi...' : 'Gửi yêu cầu liên hệ'}
                        </button>
                    </form>
                </div>
            </div>
        </Layout>
    );
}

// Styles
const labelStyle = {
    display: 'block',
    fontSize: '14px',
    fontWeight: '500',
    color: '#475569',
    marginBottom: '6px'
};

const inputStyle = {
    width: '100%',
    padding: '10px 14px',
    border: '1px solid #e2e8f0',
    borderRadius: '8px',
    fontSize: '14px',
    color: '#1e293b',
    outline: 'none',
    transition: 'border-color 0.2s'
};

const checkboxLabelStyle = {
    display: 'flex',
    alignItems: 'center',
    gap: '10px',
    fontSize: '14px',
    color: '#334155',
    cursor: 'pointer'
};

const checkboxStyle = {
    width: '18px',
    height: '18px',
    cursor: 'pointer'
};

const errorStyle = {
    display: 'block',
    fontSize: '13px',
    color: '#dc2626',
    marginTop: '4px'
};

export default Contact;
