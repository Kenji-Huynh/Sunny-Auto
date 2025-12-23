import React, { useEffect, useState, useMemo, useCallback } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import ProductCard from './ProductCard';

function ProductSection() {
    const navigate = useNavigate();
    const [products, setProducts] = useState([]);
    const [currentIndex, setCurrentIndex] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);
    
    // Touch/Swipe state for mobile
    const [touchStart, setTouchStart] = useState(null);
    const [touchEnd, setTouchEnd] = useState(null);

    useEffect(() => {
        let isMounted = true;
        setIsLoading(true);
        axios.get('/api/products/featured')
            .then(res => {
                if (!isMounted) return;
                const list = res.data.products || res.data.data || [];
                setProducts(list);
                setCurrentIndex(0);
            })
            .catch(() => {
                if (!isMounted) return;
                setError('Không thể tải sản phẩm nổi bật');
            })
            .finally(() => {
                if (!isMounted) return;
                setIsLoading(false);
            });
        return () => { isMounted = false; };
    }, []);

    const clampIndex = useCallback((idx) => {
        if (!products.length) return 0;
        return (idx + products.length) % products.length;
    }, [products.length]);

    const handlePrev = useCallback(() => {
        setCurrentIndex(prev => clampIndex(prev - 1));
    }, [clampIndex]);

    const handleNext = useCallback(() => {
        setCurrentIndex(prev => clampIndex(prev + 1));
    }, [clampIndex]);

    // Swipe handlers for mobile
    const minSwipeDistance = 50; // minimum distance for swipe

    const onTouchStart = (e) => {
        setTouchEnd(null);
        setTouchStart(e.targetTouches[0].clientX);
    };

    const onTouchMove = (e) => {
        setTouchEnd(e.targetTouches[0].clientX);
    };

    const onTouchEnd = () => {
        if (!touchStart || !touchEnd) return;
        
        const distance = touchStart - touchEnd;
        const isLeftSwipe = distance > minSwipeDistance;
        const isRightSwipe = distance < -minSwipeDistance;

        if (isLeftSwipe) {
            handleNext(); // Swipe left = next product
        }
        if (isRightSwipe) {
            handlePrev(); // Swipe right = previous product
        }
    };

    const currentProduct = useMemo(() => products[currentIndex] || null, [products, currentIndex]);

    const SectionShell = ({ children }) => (
        <section className="min-h-screen bg-gradient-to-b from-orange-50 via-white to-orange-50">
            <div className="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-14 md:py-16">
                {children}
            </div>
        </section>
    );

    if (isLoading) {
        return (
            <SectionShell>
                <div className="animate-pulse space-y-6">
                    <div className="h-8 w-56 bg-orange-600/40 rounded" />
                    <div className="h-6 w-96 bg-orange-600/40 rounded" />
                    <div className="h-[460px] bg-orange-600/30 rounded-2xl" />
                </div>
            </SectionShell>
        );
    }

    if (error) {
        return (
            <SectionShell>
                <div className="text-center">
                    <h2 className="text-2xl font-semibold">{error}</h2>
                    <p className="mt-3 opacity-80">Vui lòng thử lại sau.</p>
                </div>
            </SectionShell>
        );
    }

    if (!products.length) {
        return (
            <SectionShell>
                <div className="text-center">
                    <h2 className="text-2xl font-semibold">Chưa có sản phẩm nổi bật</h2>
                    <p className="mt-3 opacity-80">Hãy quay lại sau khi thêm sản phẩm.</p>
                </div>
            </SectionShell>
        );
    }

    return (
        <SectionShell>
            {/* Header */}
            <div className="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8">
                <div>
                    <div className="flex items-center gap-3">
                        <span className="inline-flex items-center gap-2 px-3 py-1 text-xs md:text-sm rounded-full bg-orange-100 ring-1 ring-orange-200">
                            <span className="inline-block size-1.5 rounded-full bg-orange-500 animate-pulse" />
                            Featured
                        </span>
                        {currentProduct?.category?.name && (
                            <span className="text-orange-600 text-xs md:text-sm font-medium">{currentProduct.category.name}</span>
                        )}
                    </div>
                    <h2 className="mt-3 text-3xl md:text-4xl font-bold tracking-tight bg-gradient-to-r from-orange-600 to-orange-500 bg-clip-text text-transparent">Sản phẩm nổi bật</h2>
                    <p className="mt-2 text-gray-600 max-w-2xl">Khám phá các mẫu xe điện thương mại với hiệu suất cao, phù hợp nhiều nhu cầu vận tải hiện đại.</p>
                </div>
                <button 
                    onClick={() => navigate('/shop')}
                    className="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white transition shadow-lg shadow-orange-500/30 hover:shadow-orange-600/40 hover:scale-105"
                >
                    <span className="font-medium">Xem tất cả sản phẩm</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="w-5 h-5"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {/* Tabs: product names */}
            <div className="flex flex-wrap gap-2 mb-6">
                {products.map((p, i) => (
                    <button
                        key={p.id}
                        onClick={() => setCurrentIndex(i)}
                        className={`px-3 py-1.5 rounded-lg text-sm font-medium transition ring-1 ${i === currentIndex ? 'bg-gradient-to-r from-orange-500 to-orange-600 text-white ring-transparent shadow-md' : 'bg-white hover:bg-orange-50 text-gray-700 ring-gray-200'}`}
                        aria-current={i === currentIndex ? 'true' : 'false'}
                    >
                        {p.name}
                    </button>
                ))}
            </div>

            {/* Gallery */}
            <div className="relative">
                <div className="grid grid-cols-12 gap-4 md:gap-6 items-center">
                    {/* Left arrow - Hidden on mobile, visible on desktop */}
                    <div className="hidden md:flex md:col-span-1 justify-center md:justify-start">
                        <button
                            aria-label="Previous"
                            onClick={handlePrev}
                            className="rounded-full p-3 bg-white hover:bg-orange-50 transition ring-1 ring-orange-200 text-orange-600 shadow-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="w-6 h-6"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                    </div>

                    {/* Center card with touch events for mobile swipe */}
                    <div 
                        className="col-span-12 md:col-span-10"
                        onTouchStart={onTouchStart}
                        onTouchMove={onTouchMove}
                        onTouchEnd={onTouchEnd}
                    >
                        {currentProduct && (
                            <div key={currentProduct.id} className="animate-fade-in-slide">
                                <ProductCard product={currentProduct} isLarge />
                            </div>
                        )}
                        
                        {/* Mobile swipe hint */}
                        <div className="md:hidden mt-4 text-center">
                            <p className="text-sm text-gray-500 flex items-center justify-center gap-2">
                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                                </svg>
                                <span>Vuốt để xem sản phẩm khác</span>
                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </p>
                        </div>
                    </div>

                    {/* Right arrow - Hidden on mobile, visible on desktop */}
                    <div className="hidden md:flex md:col-span-1 justify-center md:justify-end">
                        <button
                            aria-label="Next"
                            onClick={handleNext}
                            className="rounded-full p-3 bg-white hover:bg-orange-50 transition ring-1 ring-orange-200 text-orange-600 shadow-md"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="w-6 h-6"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M9 5l7 7-7 7"/></svg>
                        </button>
                    </div>
                </div>

                {/* Dots */}
                <div className="mt-6 flex items-center justify-center gap-2">
                    {products.map((_, i) => (
                        <button
                            key={i}
                            onClick={() => setCurrentIndex(i)}
                            aria-label={`Go to slide ${i + 1}`}
                            className={`h-2.5 rounded-full transition ${i === currentIndex ? 'w-6 bg-gradient-to-r from-orange-500 to-orange-600' : 'w-2.5 bg-gray-300 hover:bg-orange-300'}`}
                        />
                    ))}
                </div>
            </div>
        </SectionShell>
    );
}

export default ProductSection;
