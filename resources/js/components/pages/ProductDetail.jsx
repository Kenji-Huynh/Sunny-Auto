import React, { useState, useEffect } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import axios from 'axios';
import Layout from '../layout/Layout';
import { useWishlist } from '../context/WishlistContext';

const ProductDetail = () => {
    const { slug } = useParams();
    const navigate = useNavigate();
    const [showCopyPopup, setShowCopyPopup] = useState(false);
        // Scroll đến form contact trên trang Contact
        const handleBookTestDrive = () => {
            navigate('/contact', { state: { scrollToForm: true } });
        };

        // Mở Google Maps
        const handleGetDirections = () => {
            window.open('https://www.google.com/maps?q=Sunny+Auto+Experience+Center+HCM', '_blank');
        };

        // Copy URL sản phẩm và hiện popup
        const handleShareInstantly = () => {
            navigator.clipboard.writeText(window.location.href);
            setShowCopyPopup(true);
            setTimeout(() => setShowCopyPopup(false), 1500);
        };
    const { addToWishlist, removeFromWishlist, isInWishlist } = useWishlist();
    const [product, setProduct] = useState(null);
    const [relatedProducts, setRelatedProducts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [selectedImage, setSelectedImage] = useState(0);
    const [fadeIn, setFadeIn] = useState(false);

    useEffect(() => {
        // Reset fade và scroll khi slug thay đổi
        setFadeIn(false);
        setLoading(true);
        window.scrollTo(0, 0);
        fetchProductDetail();
    }, [slug]);

    const fetchProductDetail = async () => {
        try {
            console.log('Fetching product with slug:', slug);
            const response = await axios.get(`/api/products/${slug}`);
            console.log('API response:', response.data);
            setProduct(response.data.product);
            setRelatedProducts(response.data.related_products || []);
            setLoading(false);
            // Trigger fade-in animation sau khi load xong
            setTimeout(() => setFadeIn(true), 50);
        } catch (error) {
            console.error('Error fetching product:', error.response?.data || error.message);
            setLoading(false);
        }
    };

    const formatPrice = (price) => {
        return new Intl.NumberFormat('vi-VN').format(price);
    };

    const handleWishlistToggle = () => {
        if (!product) return;

        const inWishlist = isInWishlist(product.id);
        
        if (inWishlist) {
            removeFromWishlist(product.id);
        } else {
            addToWishlist({
                id: product.id,
                name: product.name,
                slug: product.slug,
                image: product.media?.[0]?.url || '/imgs/products/default.jpg',
                category: product.category?.name || product.brand?.name
            });
        }
    };

    if (loading) {
        return (
            <Layout>
                <div className="min-h-screen flex items-center justify-center">
                    <div className="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-orange-500"></div>
                </div>
            </Layout>
        );
    }

    if (!product) {
        return (
            <Layout>
                <div className="min-h-screen flex items-center justify-center">
                    <div className="text-center">
                        <h2 className="text-2xl font-bold text-gray-900 mb-4">Không tìm thấy sản phẩm</h2>
                        <Link to="/" className="text-orange-600 hover:text-orange-700">
                            Quay về trang chủ
                        </Link>
                    </div>
                </div>
            </Layout>
        );
    }

    const images = product.media || [];
    const currentImage = images[selectedImage];

    return (
        <Layout>
            <div className={`bg-gray-50 py-8 pt-32 transition-opacity duration-500 ${fadeIn ? 'opacity-100' : 'opacity-0'}`}>
                <div className="container mx-auto px-4">
                    {/* Breadcrumb */}
                    <nav className="mb-8">
                        <ol className="flex items-center space-x-2 text-sm text-gray-600">
                            <li><Link to="/" className="hover:text-orange-600">Home</Link></li>
                            <li>/</li>
                            <li><Link to="/" className="hover:text-orange-600">Electric vehicles</Link></li>
                            <li>/</li>
                            <li className="text-gray-900 font-medium">{product.name}</li>
                        </ol>
                    </nav>

                    <div className="grid lg:grid-cols-2 gap-12 mb-16">
                        {/* Left Side - Images (Sticky on desktop) */}
                        <div className="lg:sticky lg:top-8 lg:self-start animate-fade-in-left">
                            {/* Main Image */}
                            <div className="bg-white rounded-2xl overflow-hidden shadow-lg mb-4 transition-all duration-300">
                                <img
                                    key={selectedImage}
                                    src={currentImage?.url || '/imgs/products/default.jpg'}
                                    alt={product.name}
                                    className="w-full h-[500px] object-cover transition-opacity duration-300 animate-fade-in"
                                />
                            </div>

                            {/* Thumbnail Images */}
                            {images.length > 1 && (
                                <div className="grid grid-cols-4 gap-3">
                                    {images.map((image, index) => (
                                        <button
                                            key={image.id}
                                            onClick={() => setSelectedImage(index)}
                                            className={`relative rounded-lg overflow-hidden border-2 transition-all ${
                                                selectedImage === index
                                                    ? 'border-orange-500 shadow-lg'
                                                    : 'border-gray-200 hover:border-gray-300'
                                            }`}
                                        >
                                            <img
                                                src={image.url}
                                                alt={`${product.name} ${index + 1}`}
                                                className="w-full h-24 object-cover"
                                            />
                                        </button>
                                    ))}
                                </div>
                            )}
                        </div>

                        {/* Right Side - Product Info */}
                        <div className="animate-fade-in-right">
                            {/* Tags */}
                            <div className="flex flex-wrap gap-2 mb-4">
                                <span className="px-3 py-1 bg-gray-900 text-white text-xs font-semibold rounded">
                                    {product.brand?.name}
                                </span>
                                <span className="px-3 py-1 bg-gray-200 text-gray-900 text-xs font-semibold rounded">
                                    {product.category?.name}
                                </span>
                                <span className="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded">
                                    Available for test drive
                                </span>
                                <span className="px-3 py-1 border border-orange-500 text-orange-600 text-xs font-semibold rounded">
                                    Zero Emission
                                </span>
                            </div>

                            {/* Title */}
                            <h1 className="text-4xl font-bold text-gray-900 mb-6">{product.name}</h1>

                            {/* Price Card */}
                            <div className="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-8 mb-8 relative overflow-hidden">
                                <div className="absolute top-0 right-0 w-64 h-64 bg-orange-500/10 rounded-full -mr-32 -mt-32"></div>
                                <div className="relative z-10">
                                    <span className="inline-block px-4 py-1 bg-orange-500 text-white text-xs font-bold rounded-full mb-4">
                                        SPOTLIGHT PRICE
                                    </span>
                                    <p className="text-gray-400 text-sm mb-2">MANUFACTURER'S SUGGESTED RETAIL PRICE</p>
                                    <div className="flex items-baseline gap-2">
                                        <span className="text-5xl font-bold text-white">
                                            {formatPrice(product.msrp_price)}
                                        </span>
                                        <span className="text-2xl text-white font-semibold underline">đ</span>
                                    </div>
                                    <div className="mt-6 space-y-3">
                                        <div className="flex items-start gap-3">
                                            <svg className="w-6 h-6 text-orange-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                                            </svg>
                                            <p className="text-gray-300 text-sm">
                                                Tax incentives & charging infrastructure support up to 120,000,000 VND
                                            </p>
                                        </div>
                                        <div className="flex items-start gap-3">
                                            <svg className="w-6 h-6 text-orange-400 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                                            </svg>
                                            <p className="text-gray-300 text-sm">
                                                Complimentary 3-year maintenance plan + 12 months of home charging service
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {/* Rating */}
                            <div className="flex items-center gap-2 mb-6">
                                <div className="flex text-yellow-400">
                                    {[...Array(5)].map((_, i) => (
                                        <svg key={i} className="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z" />
                                        </svg>
                                    ))}
                                </div>
                                <span className="text-gray-600 text-sm">(5) • 128 verified owner reviews</span>
                            </div>

                            {/* Description */}
                            <div className="prose max-w-none mb-8">
                                <p className="text-gray-700 leading-relaxed">{product.description || product.short_description}</p>
                            </div>

                            {/* Demo Available Section */}
                            <div className="bg-gradient-to-br from-orange-600 to-orange-800 rounded-2xl p-8 mb-8 text-white">
                                <div className="flex items-center gap-2 mb-4">
                                    <span className="px-3 py-1 bg-white/20 backdrop-blur-sm text-xs font-bold rounded-full">
                                        DEMO AVAILABLE
                                    </span>
                                    <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                                    </svg>
                                </div>
                                <h3 className="text-2xl font-bold mb-3">Demo vehicles ready at the experience center</h3>
                                <p className="text-orange-100 mb-6">
                                    Book a session on our private test track and experience the autonomous suite in real traffic scenarios.
                                </p>

                                <div className="flex items-start gap-3 mb-6">
                                    <svg className="w-6 h-6 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <div>
                                        <p className="font-semibold">Sunny Auto Experience Center</p>
                                        <p className="text-orange-100 text-sm">12 DS Street, 14 Tech Park, Thu Duc City, Ho Chi Minh City</p>
                                    </div>
                                </div>

                                <div className="grid sm:grid-cols-2 gap-3">
                                    <button
                                        className="px-6 py-3 bg-white text-orange-700 font-semibold rounded-lg hover:bg-orange-50 transition-colors"
                                        onClick={handleBookTestDrive}
                                    >
                                        Book a test drive
                                    </button>
                                    <button
                                        className="px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 transition-colors"
                                        onClick={handleGetDirections}
                                    >
                                        Get directions to showroom
                                    </button>
                                </div>

                                <div className="grid sm:grid-cols-2 gap-3 mt-3">
                                    <button 
                                        onClick={handleWishlistToggle}
                                        className={`px-6 py-3 border-2 font-semibold rounded-lg transition-colors flex items-center justify-center gap-2 ${
                                            product && isInWishlist(product.id)
                                                ? 'bg-[#ff4500] border-[#ff4500] text-white hover:bg-[#ff5722]'
                                                : 'border-white/30 text-white hover:bg-white/10'
                                        }`}
                                    >
                                        <svg 
                                            className="w-5 h-5" 
                                            fill={product && isInWishlist(product.id) ? 'currentColor' : 'none'}
                                            stroke="currentColor" 
                                            viewBox="0 0 24 24"
                                        >
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                        {product && isInWishlist(product.id) ? 'In favorites' : 'Add to favorites'}
                                    </button>
                                    <button
                                        className="px-6 py-3 border-2 border-white/30 text-white font-semibold rounded-lg hover:bg-white/10 transition-colors flex items-center justify-center gap-2"
                                        onClick={handleShareInstantly}
                                    >
                                        <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                        Share instantly
                                    </button>
                                            {/* Popup thông báo đã copy URL */}
                                            {showCopyPopup && (
                                                <div className="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-orange-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in">
                                                    Đã copy URL
                                                </div>
                                            )}
                                </div>
                            </div>

                            {/* Ownership Benefits */}
                            <div className="bg-gradient-to-br from-orange-600 to-orange-800 rounded-2xl p-8 text-white">
                                <div className="flex items-center gap-2 mb-6">
                                    <span className="px-3 py-1 bg-white/20 backdrop-blur-sm text-xs font-bold rounded-full">
                                        OWNERSHIP BENEFITS
                                    </span>
                                </div>
                                <h3 className="text-2xl font-bold mb-3">Ownership experience & benefits</h3>
                                <p className="text-orange-100 mb-8">
                                    Premium services designed exclusively for Sunny Auto drivers—from immersive test drives to concierge-level support throughout your ownership journey.
                                </p>

                                <div className="space-y-4">
                                    <div className="bg-white/10 backdrop-blur-sm rounded-xl p-6 hover:bg-white/15 transition-colors">
                                        <div className="flex items-start gap-4">
                                            <div className="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 className="text-lg font-bold mb-2">Schedule a test drive</h4>
                                                <p className="text-orange-100 text-sm">
                                                    Experience instant torque and autonomous assistance on our dedicated EV proving ground.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="bg-white/10 backdrop-blur-sm rounded-xl p-6 hover:bg-white/15 transition-colors">
                                        <div className="flex items-start gap-4">
                                            <div className="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 className="text-lg font-bold mb-2">Flexible financing</h4>
                                                <p className="text-orange-100 text-sm">
                                                    Get tailored financing with 0% APR for 12 months for returning Sunny Auto owners.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div className="bg-white/10 backdrop-blur-sm rounded-xl p-6 hover:bg-white/15 transition-colors">
                                        <div className="flex items-start gap-4">
                                            <div className="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 className="text-lg font-bold mb-2">Download brochure</h4>
                                                <p className="text-orange-100 text-sm">
                                                    Access deep-dives on battery tech, active safety, and Sunny Auto's charging standards.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {/* Technical Specifications Section */}
                    {product.evc_spec && (
                        <div className="bg-white rounded-2xl p-8 shadow-lg mb-16">
                            <h2 className="text-3xl font-bold text-gray-900 mb-8">Technical Specifications</h2>
                            <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                                {product.evc_spec.battery_capacity_kwh && (
                                    <div className="border border-gray-200 rounded-xl p-6">
                                        <p className="text-sm text-gray-600 mb-2">Battery Capacity</p>
                                        <p className="text-2xl font-bold text-gray-900">
                                            {product.evc_spec.battery_capacity_kwh} kWh
                                        </p>
                                        {product.evc_spec.battery_type && (
                                            <p className="text-sm text-gray-600 mt-1">
                                                {product.evc_spec.battery_type} ({product.evc_spec.battery_supplier})
                                            </p>
                                        )}
                                    </div>
                                )}
                                {product.evc_spec.range_km && (
                                    <div className="border border-gray-200 rounded-xl p-6">
                                        <p className="text-sm text-gray-600 mb-2">Driving Range</p>
                                        <p className="text-2xl font-bold text-gray-900">{product.evc_spec.range_km} km</p>
                                        {product.evc_spec.range_test_standard && (
                                            <p className="text-sm text-gray-600 mt-1">{product.evc_spec.range_test_standard}</p>
                                        )}
                                    </div>
                                )}
                                {product.evc_spec.power_kw && (
                                    <div className="border border-gray-200 rounded-xl p-6">
                                        <p className="text-sm text-gray-600 mb-2">Motor Power</p>
                                        <p className="text-2xl font-bold text-gray-900">{product.evc_spec.power_kw} kW</p>
                                    </div>
                                )}
                                {product.evc_spec.torque_nm && (
                                    <div className="border border-gray-200 rounded-xl p-6">
                                        <p className="text-sm text-gray-600 mb-2">Torque</p>
                                        <p className="text-2xl font-bold text-gray-900">{product.evc_spec.torque_nm} Nm</p>
                                    </div>
                                )}
                                {product.evc_spec.charge_10_80_min && (
                                    <div className="border border-gray-200 rounded-xl p-6">
                                        <p className="text-sm text-gray-600 mb-2">Fast Charging (10-80%)</p>
                                        <p className="text-2xl font-bold text-gray-900">{product.evc_spec.charge_10_80_min} min</p>
                                    </div>
                                )}
                                {product.evc_spec.onboard_charger_kw && (
                                    <div className="border border-gray-200 rounded-xl p-6">
                                        <p className="text-sm text-gray-600 mb-2">Onboard Charger</p>
                                        <p className="text-2xl font-bold text-gray-900">{product.evc_spec.onboard_charger_kw} kW</p>
                                    </div>
                                )}
                            </div>
                        </div>
                    )}

                    {/* Related Products */}
                    {relatedProducts.length > 0 && (
                        <div className="mb-16">
                            <h2 className="text-3xl font-bold text-gray-900 mb-8">You might also like</h2>
                            <div className="grid md:grid-cols-3 gap-8">
                                {relatedProducts.map((relatedProduct) => (
                                    <Link
                                        key={relatedProduct.id}
                                        to={`/products-detail/${relatedProduct.slug}`}
                                        className="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2"
                                    >
                                        <div className="relative h-64 overflow-hidden">
                                            <img
                                                src={relatedProduct.primary_image?.url || '/imgs/products/default.jpg'}
                                                alt={relatedProduct.name}
                                                className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                            />
                                        </div>
                                        <div className="p-6">
                                            <p className="text-sm text-gray-600 mb-2">{relatedProduct.brand?.name}</p>
                                            <h3 className="text-xl font-bold text-gray-900 mb-3 group-hover:text-orange-600 transition-colors">
                                                {relatedProduct.name}
                                            </h3>
                                            <p className="text-sm text-gray-600 mb-4 line-clamp-2">{relatedProduct.short_description}</p>
                                            <div className="flex items-center justify-between">
                                                <span className="text-2xl font-bold text-gray-900">
                                                    {formatPrice(relatedProduct.msrp_price)} đ
                                                </span>
                                                <svg className="w-6 h-6 text-orange-600 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                        </div>
                                    </Link>
                                ))}
                            </div>
                        </div>
                    )}
                </div>
            </div>
        </Layout>
    );
};

export default ProductDetail;
