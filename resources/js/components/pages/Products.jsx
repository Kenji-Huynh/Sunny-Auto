import React, { useState, useEffect } from 'react';
import { useSearchParams, Link } from 'react-router-dom';
import axios from 'axios';
import Layout from '../layout/Layout';

const Products = () => {
    const [searchParams, setSearchParams] = useSearchParams();
    const [products, setProducts] = useState([]);
    const [pagination, setPagination] = useState(null);
    const [filters, setFilters] = useState({ categories: [], brands: [] });
    const [loading, setLoading] = useState(true);
    const [fadeIn, setFadeIn] = useState(false);

    // Filter states
    const [selectedCategory, setSelectedCategory] = useState(searchParams.get('category') || '');
    const [selectedBrand, setSelectedBrand] = useState(searchParams.get('brand') || '');
    const [searchQuery, setSearchQuery] = useState(searchParams.get('search') || '');
    const [sortBy, setSortBy] = useState(searchParams.get('sort') || 'latest');
    const [minPrice, setMinPrice] = useState(searchParams.get('min_price') || '');
    const [maxPrice, setMaxPrice] = useState(searchParams.get('max_price') || '');
    const [viewMode, setViewMode] = useState('grid');

    useEffect(() => {
        fetchProducts();
        window.scrollTo(0, 0);
    }, [searchParams]);

    const fetchProducts = async () => {
        setFadeIn(false);
        setLoading(true);
        try {
            const params = new URLSearchParams();
            if (searchParams.get('category')) params.append('category', searchParams.get('category'));
            if (searchParams.get('brand')) params.append('brand', searchParams.get('brand'));
            if (searchParams.get('search')) params.append('search', searchParams.get('search'));
            if (searchParams.get('sort')) params.append('sort', searchParams.get('sort'));
            if (searchParams.get('min_price')) params.append('min_price', searchParams.get('min_price'));
            if (searchParams.get('max_price')) params.append('max_price', searchParams.get('max_price'));
            if (searchParams.get('page')) params.append('page', searchParams.get('page'));

            const response = await axios.get(`/api/products?${params.toString()}`);
            setProducts(response.data.products);
            setPagination(response.data.pagination);
            setFilters(response.data.filters);
            setLoading(false);
            setTimeout(() => setFadeIn(true), 50);
        } catch (error) {
            console.error('Error fetching products:', error);
            setLoading(false);
        }
    };

    const updateFilters = (key, value) => {
        const newParams = new URLSearchParams(searchParams);
        if (value) {
            newParams.set(key, value);
        } else {
            newParams.delete(key);
        }
        newParams.delete('page'); // Reset pagination when filter changes
        setSearchParams(newParams);
    };

    const clearAllFilters = () => {
        setSelectedCategory('');
        setSelectedBrand('');
        setSearchQuery('');
        setSortBy('latest');
        setMinPrice('');
        setMaxPrice('');
        setSearchParams(new URLSearchParams());
    };

    const handleSearch = (e) => {
        e.preventDefault();
        updateFilters('search', searchQuery);
    };

    const handlePriceFilter = () => {
        const newParams = new URLSearchParams(searchParams);
        if (minPrice) newParams.set('min_price', minPrice);
        else newParams.delete('min_price');
        if (maxPrice) newParams.set('max_price', maxPrice);
        else newParams.delete('max_price');
        newParams.delete('page');
        setSearchParams(newParams);
    };

    const goToPage = (page) => {
        const newParams = new URLSearchParams(searchParams);
        newParams.set('page', page);
        setSearchParams(newParams);
    };

    // Get current category info for header
    const currentCategory = filters.categories?.find(c => c.slug === selectedCategory);

    const getCategoryTitle = () => {
        if (selectedCategory === 'he-thong-tram-sac') return 'Charging Station';
        if (selectedCategory === 'xe-tai-dien' || selectedCategory === 'light-truck') return 'Light Truck';
        if (currentCategory) return currentCategory.name;
        return 'All Products';
    };

    const getCategoryDescription = () => {
        if (selectedCategory === 'he-thong-tram-sac') return 'Hệ thống trạm sạc điện tiên tiến cho xe điện';
        if (selectedCategory === 'xe-tai-dien' || selectedCategory === 'light-truck') return 'Xe tải hạng nhẹ chuyên phục vụ việc phân phối đô thị';
        if (currentCategory?.description) return currentCategory.description;
        return 'Khám phá bộ sưu tập xe điện và thiết bị sạc đa dạng của chúng tôi';
    };

    const getBannerImage = () => {
        if (selectedCategory === 'he-thong-tram-sac') return '/imgs/products/thumbnail-station.jpg';
        if (selectedCategory === 'xe-tai-dien' || selectedCategory === 'light-truck') return '/imgs/products/thumbnail-electric-truck.jpg';
        return '/imgs/products/unnamed.jpg';
    };

    return (
        <Layout>
            {/* Hero Banner */}
            <div className="relative h-[300px] md:h-[400px] overflow-hidden">
                <img
                    src={getBannerImage()}
                    alt="Products Banner"
                    className="w-full h-full object-cover"
                />
                <div className="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
                <div className="absolute inset-0 flex items-center">
                    <div className="container mx-auto px-4">
                        <div className="max-w-2xl">
                            <h1 className="text-4xl md:text-5xl font-bold text-white mb-4 animate-fade-in-left">
                                {getCategoryTitle()}
                            </h1>
                            <p className="text-lg text-gray-200 animate-fade-in-left" style={{ animationDelay: '0.1s' }}>
                                {getCategoryDescription()}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {/* Main Content */}
            <div className={`bg-white py-8 transition-opacity duration-500 ${fadeIn ? 'opacity-100' : 'opacity-0'}`}>
                <div className="container mx-auto px-4">
                    {/* Search Bar */}
                    <div className="mb-6">
                        <form onSubmit={handleSearch} className="relative max-w-2xl">
                            <input
                                type="text"
                                value={searchQuery}
                                onChange={(e) => setSearchQuery(e.target.value)}
                                placeholder="Tìm kiếm sản phẩm..."
                                className="w-full pl-4 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            />
                            <button
                                type="submit"
                                className="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-500 hover:text-orange-500"
                            >
                                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    {/* Filters Row */}
                    <div className="flex flex-wrap items-center gap-4 mb-6 pb-6 border-b border-gray-200">
                        {/* Category Filter */}
                        <select
                            value={selectedCategory}
                            onChange={(e) => {
                                setSelectedCategory(e.target.value);
                                updateFilters('category', e.target.value);
                            }}
                            className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white"
                        >
                            <option value="">All Categories</option>
                            {filters.categories?.map((cat) => (
                                <option key={cat.id} value={cat.slug}>
                                    {cat.name}
                                </option>
                            ))}
                        </select>

                        {/* Sort Filter */}
                        <select
                            value={sortBy}
                            onChange={(e) => {
                                setSortBy(e.target.value);
                                updateFilters('sort', e.target.value);
                            }}
                            className="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white"
                        >
                            <option value="latest">Tên A-Z</option>
                            <option value="name_asc">Tên A-Z</option>
                            <option value="name_desc">Tên Z-A</option>
                            <option value="price_asc">Giá thấp - cao</option>
                            <option value="price_desc">Giá cao - thấp</option>
                        </select>

                        {/* Price Range */}
                        <div className="flex items-center gap-2">
                            <span className="text-gray-600 text-sm">Khoảng giá</span>
                            <input
                                type="number"
                                value={minPrice}
                                onChange={(e) => setMinPrice(e.target.value)}
                                placeholder="0"
                                className="w-24 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            />
                            <input
                                type="number"
                                value={maxPrice}
                                onChange={(e) => setMaxPrice(e.target.value)}
                                placeholder="0"
                                className="w-24 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            />
                            <button
                                onClick={handlePriceFilter}
                                className="p-2 text-gray-500 hover:text-orange-500"
                            >
                                <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>

                        {/* View Mode Toggle */}
                        <div className="flex items-center gap-2 ml-auto">
                            <span className="text-gray-600 text-sm">Hiển thị</span>
                            <button
                                onClick={() => setViewMode('grid')}
                                className={`p-2 rounded ${viewMode === 'grid' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-600'}`}
                            >
                                <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 4h4v4H4V4zm6 0h4v4h-4V4zm6 0h4v4h-4V4zm-12 6h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4zm-12 6h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z" />
                                </svg>
                            </button>
                            <button
                                onClick={() => setViewMode('list')}
                                className={`p-2 rounded ${viewMode === 'list' ? 'bg-orange-500 text-white' : 'bg-gray-100 text-gray-600'}`}
                            >
                                <svg className="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {/* Active Filters Tags */}
                    {(selectedCategory || selectedBrand || searchQuery || minPrice || maxPrice) && (
                        <div className="flex flex-wrap items-center gap-2 mb-6">
                            {selectedCategory && (
                                <span className="inline-flex items-center gap-1 px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm">
                                    Danh mục: {filters.categories?.find(c => c.slug === selectedCategory)?.name}
                                    <button onClick={() => { setSelectedCategory(''); updateFilters('category', ''); }} className="ml-1 hover:text-orange-900">×</button>
                                </span>
                            )}
                            {selectedBrand && (
                                <span className="inline-flex items-center gap-1 px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm">
                                    Brand: {filters.brands?.find(b => b.slug === selectedBrand)?.name}
                                    <button onClick={() => { setSelectedBrand(''); updateFilters('brand', ''); }} className="ml-1 hover:text-orange-900">×</button>
                                </span>
                            )}
                            {searchQuery && (
                                <span className="inline-flex items-center gap-1 px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm">
                                    Tìm: {searchQuery}
                                    <button onClick={() => { setSearchQuery(''); updateFilters('search', ''); }} className="ml-1 hover:text-orange-900">×</button>
                                </span>
                            )}
                            {(minPrice || maxPrice) && (
                                <span className="inline-flex items-center gap-1 px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm">
                                    Giá: ${minPrice || '0'} - ${maxPrice || '∞'}
                                    <button onClick={() => { setMinPrice(''); setMaxPrice(''); handlePriceFilter(); }} className="ml-1 hover:text-orange-900">×</button>
                                </span>
                            )}
                            <button
                                onClick={clearAllFilters}
                                className="text-sm text-gray-500 hover:text-orange-500 underline"
                            >
                                Xóa tất cả
                            </button>
                        </div>
                    )}

                    {/* Results Count */}
                    <div className="flex items-center justify-between mb-6">
                        <p className="text-gray-600">
                            <span className="text-orange-500 font-semibold">Hiển thị {products.length > 0 ? `1-${products.length}` : '0'}</span>
                            {' '}trong {pagination?.total || 0} sản phẩm
                        </p>
                        <div className="flex items-center gap-2">
                            <span className="text-gray-600 text-sm">Sản phẩm mỗi trang:</span>
                            <select
                                className="px-3 py-1 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-white"
                                value={searchParams.get('per_page') || '12'}
                                onChange={(e) => updateFilters('per_page', e.target.value)}
                            >
                                <option value="12">12</option>
                                <option value="24">24</option>
                                <option value="48">48</option>
                            </select>
                        </div>
                    </div>

                    {/* Products Grid */}
                    {loading ? (
                        <div className="flex items-center justify-center py-20">
                            <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-orange-500"></div>
                        </div>
                    ) : products.length === 0 ? (
                        <div className="text-center py-20">
                            <svg className="mx-auto w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 className="text-xl font-semibold text-gray-900 mb-2">Không tìm thấy sản phẩm</h3>
                            <p className="text-gray-500">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm</p>
                        </div>
                    ) : (
                        <div className={`grid gap-6 ${viewMode === 'grid' ? 'grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4' : 'grid-cols-1'}`}>
                            {products.map((product, index) => (
                                <ProductCard key={product.id} product={product} viewMode={viewMode} index={index} />
                            ))}
                        </div>
                    )}

                    {/* Pagination */}
                    {pagination && pagination.last_page > 1 && (
                        <div className="flex items-center justify-center gap-2 mt-12">
                            <button
                                onClick={() => goToPage(pagination.current_page - 1)}
                                disabled={pagination.current_page === 1}
                                className="px-4 py-2 border border-gray-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50"
                            >
                                ←
                            </button>
                            {[...Array(pagination.last_page)].map((_, i) => (
                                <button
                                    key={i}
                                    onClick={() => goToPage(i + 1)}
                                    className={`px-4 py-2 rounded-lg ${
                                        pagination.current_page === i + 1
                                            ? 'bg-orange-500 text-white'
                                            : 'border border-gray-300 hover:bg-gray-50'
                                    }`}
                                >
                                    {i + 1}
                                </button>
                            ))}
                            <button
                                onClick={() => goToPage(pagination.current_page + 1)}
                                disabled={pagination.current_page === pagination.last_page}
                                className="px-4 py-2 border border-gray-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-gray-50"
                            >
                                →
                            </button>
                        </div>
                    )}
                </div>
            </div>
        </Layout>
    );
};

// Product Card Component
const ProductCard = ({ product, viewMode, index }) => {
    const [isHovered, setIsHovered] = useState(false);

    if (viewMode === 'list') {
        return (
            <Link
                to={`/products-detail/${product.slug}`}
                className="flex gap-6 p-4 bg-white border border-gray-200 rounded-xl hover:shadow-lg transition-all duration-300 animate-fade-in"
                style={{ animationDelay: `${index * 0.05}s` }}
            >
                <div className="w-48 h-32 flex-shrink-0 overflow-hidden rounded-lg">
                    <img
                        src={product.primary_image}
                        alt={product.name}
                        className="w-full h-full object-cover"
                    />
                </div>
                <div className="flex-grow">
                    <div className="flex items-center gap-2 mb-2">
                        {product.brand && (
                            <span className="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">{product.brand.name}</span>
                        )}
                        {product.category && (
                            <span className="px-2 py-0.5 bg-orange-100 text-orange-600 text-xs rounded">{product.category.name}</span>
                        )}
                    </div>
                    <h3 className="text-lg font-bold text-gray-900 mb-2">{product.name}</h3>
                    <p className="text-gray-500 text-sm line-clamp-2 mb-3">{product.short_description}</p>
                    <div className="flex items-center justify-between">
                        <span className="text-lg font-bold text-orange-500">{product.formatted_price}</span>
                        <span className="text-orange-500 text-sm flex items-center gap-1">
                            <svg className="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fillRule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clipRule="evenodd" />
                            </svg>
                            Xem Details
                        </span>
                    </div>
                </div>
            </Link>
        );
    }

    return (
        <Link
            to={`/products-detail/${product.slug}`}
            className="group bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] animate-fade-in"
            style={{ animationDelay: `${index * 0.05}s` }}
            onMouseEnter={() => setIsHovered(true)}
            onMouseLeave={() => setIsHovered(false)}
        >
            {/* Image Container */}
            <div className="relative aspect-[4/3] overflow-hidden bg-gray-50">
                <img
                    src={product.primary_image}
                    alt={product.name}
                    className={`w-full h-full object-contain p-4 transition-all duration-500 ${isHovered ? 'scale-110' : ''}`}
                />
                
                {/* Hover Overlay */}
                <div className={`absolute inset-0 bg-black/60 flex items-center justify-center transition-opacity duration-300 ${isHovered ? 'opacity-100' : 'opacity-0'}`}>
                    <div className="text-center text-white">
                        {product.evc_spec && (
                            <div className="grid grid-cols-2 gap-3 text-sm">
                                {product.evc_spec.range_km && (
                                    <div className="bg-white/10 px-3 py-2 rounded">
                                        <p className="text-orange-300 text-xs">Range</p>
                                        <p className="font-bold">{product.evc_spec.range_km}</p>
                                    </div>
                                )}
                                {product.evc_spec.power_kw && (
                                    <div className="bg-white/10 px-3 py-2 rounded">
                                        <p className="text-orange-300 text-xs">Power</p>
                                        <p className="font-bold">{product.evc_spec.power_kw}</p>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </div>
            </div>

            {/* Content */}
            <div className="p-4">
                {/* Tags */}
                <div className="flex items-center gap-2 mb-2">
                    {product.brand && (
                        <span className="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded">{product.brand.name}</span>
                    )}
                    {product.category && (
                        <span className="px-2 py-0.5 bg-orange-100 text-orange-600 text-xs rounded">{product.category.name}</span>
                    )}
                </div>

                {/* Title */}
                <h3 className="font-bold text-gray-900 mb-1 line-clamp-1 group-hover:text-orange-500 transition-colors">
                    {product.name}
                </h3>

                {/* Description */}
                <p className="text-gray-500 text-sm line-clamp-2 mb-3">{product.short_description}</p>

                {/* Price & Actions */}
                <div className="flex items-center justify-between pt-3 border-t border-gray-100">
                    <span className="text-lg font-bold text-orange-500">{product.formatted_price}</span>
                    <div className="flex items-center gap-2">
                        <button className="p-2 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <button className="p-2 rounded-full hover:bg-gray-100 text-gray-400 hover:text-red-500 transition-colors">
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                        <button className="p-2 rounded-full hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                            <svg className="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {/* See Details Button */}
            <div className="px-4 pb-4">
                <span className="flex items-center justify-center gap-2 w-full py-2 bg-gray-900 text-white rounded-lg text-sm font-semibold group-hover:bg-orange-500 transition-colors">
                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    See Details
                </span>
            </div>
        </Link>
    );
};

export default Products;
