import React, { useEffect, useState, useMemo, useCallback } from 'react';
import axios from 'axios';
import ProductCard from './ProductCard';

function ProductSection() {
    const [products, setProducts] = useState([]);
    const [currentIndex, setCurrentIndex] = useState(0);
    const [isLoading, setIsLoading] = useState(true);
    const [error, setError] = useState(null);

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

    const currentProduct = useMemo(() => products[currentIndex] || null, [products, currentIndex]);

    const SectionShell = ({ children }) => (
        <section className="min-h-screen bg-gradient-to-b from-emerald-950 via-emerald-900 to-emerald-800 text-white">
            <div className="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 py-14 md:py-16">
                {children}
            </div>
        </section>
    );

    if (isLoading) {
        return (
            <SectionShell>
                <div className="animate-pulse space-y-6">
                    <div className="h-8 w-56 bg-emerald-600/40 rounded" />
                    <div className="h-6 w-96 bg-emerald-600/40 rounded" />
                    <div className="h-[460px] bg-emerald-600/30 rounded-2xl" />
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
                        <span className="inline-flex items-center gap-2 px-3 py-1 text-xs md:text-sm rounded-full bg-white/10 ring-1 ring-white/15">
                            <span className="inline-block size-1.5 rounded-full bg-emerald-400" />
                            Featured
                        </span>
                        {currentProduct?.category?.name && (
                            <span className="text-emerald-200 text-xs md:text-sm">{currentProduct.category.name}</span>
                        )}
                    </div>
                    <h2 className="mt-3 text-3xl md:text-4xl font-bold tracking-tight">Sản phẩm nổi bật</h2>
                    <p className="mt-2 text-emerald-100 max-w-2xl">Khám phá các mẫu xe điện thương mại với hiệu suất cao, phù hợp nhiều nhu cầu vận tải hiện đại.</p>
                </div>
                <button className="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white/10 hover:bg-white/15 transition ring-1 ring-white/15">
                    <span>Xem tất cả sản phẩm</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="w-5 h-5"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>

            {/* Tabs: product names */}
            <div className="flex flex-wrap gap-2 mb-6">
                {products.map((p, i) => (
                    <button
                        key={p.id}
                        onClick={() => setCurrentIndex(i)}
                        className={`px-3 py-1.5 rounded-lg text-sm transition ring-1 ${i === currentIndex ? 'bg-white text-emerald-900 ring-transparent' : 'bg-white/5 hover:bg-white/10 ring-white/10'}`}
                        aria-current={i === currentIndex ? 'true' : 'false'}
                    >
                        {p.name}
                    </button>
                ))}
            </div>

            {/* Gallery */}
            <div className="relative">
                <div className="grid grid-cols-12 gap-4 md:gap-6 items-center">
                    {/* Left arrow */}
                    <div className="col-span-12 md:col-span-1 order-3 md:order-none flex justify-center md:justify-start">
                        <button
                            aria-label="Previous"
                            onClick={handlePrev}
                            className="rounded-full p-3 bg-white/10 hover:bg-white/20 transition ring-1 ring-white/15"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" className="w-6 h-6"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 19l-7-7 7-7"/></svg>
                        </button>
                    </div>

                    {/* Center card */}
                    <div className="col-span-12 md:col-span-10 order-1 md:order-none">
                        {currentProduct && (
                            <div key={currentProduct.id} className="animate-fade-in-slide">
                                <ProductCard product={currentProduct} isLarge />
                            </div>
                        )}
                    </div>

                    {/* Right arrow */}
                    <div className="col-span-12 md:col-span-1 order-2 md:order-none flex justify-center md:justify-end">
                        <button
                            aria-label="Next"
                            onClick={handleNext}
                            className="rounded-full p-3 bg-white/10 hover:bg-white/20 transition ring-1 ring-white/15"
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
                            className={`h-2.5 rounded-full transition ${i === currentIndex ? 'w-6 bg-white' : 'w-2.5 bg-white/40 hover:bg-white/60'}`}
                        />
                    ))}
                </div>
            </div>
        </SectionShell>
    );
}

export default ProductSection;
