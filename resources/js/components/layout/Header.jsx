import React, { useState, useEffect, useRef } from 'react';
import { Link, useLocation } from 'react-router-dom';
import axios from 'axios';
import { useWishlist } from '../context/WishlistContext';

function Header() {
    const location = useLocation();
    const { wishlist, removeFromWishlist, wishlistCount } = useWishlist();
    const [isSearchOpen, setIsSearchOpen] = useState(false);
    const [isWishlistOpen, setIsWishlistOpen] = useState(false);
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const [searchQuery, setSearchQuery] = useState('');
    const [searchResults, setSearchResults] = useState({ products: [], suggestions: [] });
    const [isSearching, setIsSearching] = useState(false);
    const [isScrolled, setIsScrolled] = useState(false);
    const searchRef = useRef(null);
    const wishlistRef = useRef(null);
    const mobileMenuRef = useRef(null);
    const searchTimeoutRef = useRef(null);

    // Check if we're on home page
    const isHomePage = location.pathname === '/';

    useEffect(() => {
        const handleScroll = () => {
            if (window.scrollY > 50) {
                setIsScrolled(true);
            } else {
                setIsScrolled(false);
            }
        };

        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    // Search products with debounce
    useEffect(() => {
        if (searchTimeoutRef.current) {
            clearTimeout(searchTimeoutRef.current);
        }

        if (searchQuery.trim().length > 0) {
            setIsSearching(true);
            searchTimeoutRef.current = setTimeout(async () => {
                try {
                    const response = await axios.get('/api/products/search', {
                        params: { q: searchQuery }
                    });
                    setSearchResults(response.data);
                } catch (error) {
                    console.error('Search error:', error);
                    setSearchResults({ products: [], suggestions: [] });
                } finally {
                    setIsSearching(false);
                }
            }, 300);
        } else {
            setSearchResults({ products: [], suggestions: [] });
            setIsSearching(false);
        }

        return () => {
            if (searchTimeoutRef.current) {
                clearTimeout(searchTimeoutRef.current);
            }
        };
    }, [searchQuery]);

    // Close search when clicking outside
    useEffect(() => {
        const handleClickOutside = (event) => {
            if (searchRef.current && !searchRef.current.contains(event.target)) {
                setIsSearchOpen(false);
            }
            if (wishlistRef.current && !wishlistRef.current.contains(event.target)) {
                setIsWishlistOpen(false);
            }
            if (mobileMenuRef.current && !mobileMenuRef.current.contains(event.target)) {
                setIsMobileMenuOpen(false);
            }
        };

        document.addEventListener('mousedown', handleClickOutside);
        return () => document.removeEventListener('mousedown', handleClickOutside);
    }, []);

    return (
        <>
        <header className={`fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b ${
            isHomePage
                ? (isScrolled
                    ? 'bg-white shadow-sm border-gray-200'
                    : 'bg-transparent border-white/20')
                : 'bg-white shadow-sm border-gray-200'
        }`}>
            <div className="container mx-auto px-6 py-4">
                <div className="flex items-center justify-between">
                    {/* Logo bên trái */}
                    <Link to="/" className="flex items-center">
                        <img 
                            src="/imgs/logo/logo.png" 
                            alt="Sunny Auto" 
                            className="h-10 w-auto"
                        />
                    </Link>

                    {/* Menu ở giữa */}
                    <nav className="hidden md:flex items-center space-x-8">
                        <Link 
                            to="/about"
                            className={`font-medium hover:text-[#ff4500] transition-colors duration-300 ${
                                isHomePage && !isScrolled ? 'text-white' : 'text-gray-800'
                            }`}
                        >
                            About
                        </Link>
                        <Link 
                            to="/contact" 
                            className={`font-medium hover:text-[#ff4500] transition-colors duration-300 ${
                                isHomePage && !isScrolled ? 'text-white' : 'text-gray-800'
                            }`}
                        >
                            Contact
                        </Link>
                        <Link 
                            to="/blog" 
                            className={`font-medium hover:text-[#ff4500] transition-colors duration-300 ${
                                isHomePage && !isScrolled ? 'text-white' : 'text-gray-800'
                            }`}
                        >
                            Blog
                        </Link>
                    </nav>

                    {/* Search + Icons bên phải */}
                    <div className="flex items-center space-x-4">
                        {/* Search Box - Compact style like reference */}
                        <div className="relative" ref={searchRef}>
                            {isSearchOpen ? (
                                <div className="flex items-center">
                                    {/* Search Input Container */}
                                    <div className={`flex items-center rounded-lg border-2 transition-all duration-300 ${
                                        isScrolled 
                                            ? 'bg-gray-100 border-gray-300' 
                                            : 'bg-gray-800/90 border-gray-600'
                                    }`}>
                                        {/* Search Icon inside input */}
                                        <svg 
                                            xmlns="http://www.w3.org/2000/svg" 
                                            className={`h-5 w-5 ml-3 ${isScrolled ? 'text-gray-500' : 'text-gray-400'}`}
                                            fill="none" 
                                            viewBox="0 0 24 24" 
                                            stroke="currentColor"
                                        >
                                            <path 
                                                strokeLinecap="round" 
                                                strokeLinejoin="round" 
                                                strokeWidth={2} 
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" 
                                            />
                                        </svg>
                                        
                                        {/* Input */}
                                        <input
                                            type="text"
                                            value={searchQuery}
                                            onChange={(e) => setSearchQuery(e.target.value)}
                                            placeholder="Tìm kiếm..."
                                            className={`w-48 px-3 py-2 bg-transparent outline-none text-sm ${
                                                isScrolled 
                                                    ? 'text-gray-800 placeholder-gray-500' 
                                                    : 'text-white placeholder-gray-400'
                                            }`}
                                            autoFocus
                                        />

                                        {/* Clear button */}
                                        {searchQuery && (
                                            <button 
                                                onClick={() => setSearchQuery('')}
                                                className={`px-2 ${isScrolled ? 'text-gray-500 hover:text-gray-700' : 'text-gray-400 hover:text-white'}`}
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" className="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        )}
                                    </div>

                                    {/* Close Search Button */}
                                    <button 
                                        onClick={() => {
                                            setIsSearchOpen(false);
                                            setSearchQuery('');
                                        }}
                                        className={`ml-2 p-1 rounded transition-colors ${
                                            isScrolled 
                                                ? 'text-gray-600 hover:text-gray-800' 
                                                : 'text-white/70 hover:text-white'
                                        }`}
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            ) : (
                                /* Search Icon Button */
                                <button 
                                    onClick={() => setIsSearchOpen(true)}
                                    className={`p-0 hover:text-[#ff4500] transition-colors duration-300 ${
                                        isHomePage && !isScrolled ? 'text-white' : 'text-gray-800'
                                    }`}
                                    aria-label="Search"
                                >
                                    <svg 
                                        xmlns="http://www.w3.org/2000/svg" 
                                        className="h-6 w-6" 
                                        fill="none" 
                                        viewBox="0 0 24 24" 
                                        stroke="currentColor"
                                        strokeWidth={2}
                                    >
                                        <path 
                                            strokeLinecap="round" 
                                            strokeLinejoin="round" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" 
                                        />
                                    </svg>
                                </button>
                            )}

                            {/* Search Results Dropdown */}
                            {isSearchOpen && searchQuery && (
                                <div className="absolute top-full right-0 mt-2 w-80 rounded-xl shadow-2xl border bg-[#1a1d29] border-gray-700 overflow-hidden">
                                    {isSearching ? (
                                        <div className="px-4 py-8 text-sm text-center text-gray-400">
                                            <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-[#ff4500] mx-auto"></div>
                                            <p className="mt-2">Đang tìm kiếm...</p>
                                        </div>
                                    ) : searchResults.products.length > 0 ? (
                                        <div>
                                            {/* Products Section */}
                                            <div className="px-4 py-2 border-b border-gray-700">
                                                <h3 className="text-xs font-medium text-gray-400">Sản phẩm</h3>
                                            </div>
                                            <div className="max-h-96 overflow-y-auto">
                                                {searchResults.products.map((product) => (
                                                    <Link
                                                        key={product.id}
                                                        to={`/products-detail/${product.slug}`}
                                                        className="flex items-center gap-3 px-4 py-3 hover:bg-gray-800/50 transition-colors border-b border-gray-800 last:border-0"
                                                        onClick={() => {
                                                            setIsSearchOpen(false);
                                                            setSearchQuery('');
                                                        }}
                                                    >
                                                        {/* Product Image */}
                                                        <div className="flex-shrink-0 w-14 h-14 bg-gray-700 rounded-lg overflow-hidden">
                                                            {product.image ? (
                                                                <img
                                                                    src={product.image}
                                                                    alt={product.name}
                                                                    className="w-full h-full object-cover"
                                                                />
                                                            ) : (
                                                                <div className="w-full h-full flex items-center justify-center">
                                                                    <svg className="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                    </svg>
                                                                </div>
                                                            )}
                                                        </div>
                                                        
                                                        {/* Product Info */}
                                                        <div className="flex-1 min-w-0">
                                                            <h4 className="text-sm font-medium text-white truncate">
                                                                {product.name}
                                                            </h4>
                                                            {product.brand && (
                                                                <p className="text-xs text-gray-400 mt-0.5">
                                                                    {product.brand}
                                                                </p>
                                                            )}
                                                            <p className="text-sm font-semibold text-emerald-400 mt-1">
                                                                {product.formatted_price}
                                                            </p>
                                                        </div>
                                                    </Link>
                                                ))}
                                            </div>
                                            
                                            {/* Suggestions Section */}
                                            {searchResults.suggestions && searchResults.suggestions.length > 0 && (
                                                <div className="border-t border-gray-700">
                                                    <div className="px-4 py-2">
                                                        <h3 className="text-xs font-medium text-gray-400 mb-2">Đề xuất tìm kiếm</h3>
                                                        {searchResults.suggestions.map((suggestion, index) => (
                                                            <button
                                                                key={index}
                                                                onClick={() => setSearchQuery(suggestion)}
                                                                className="flex items-center gap-2 w-full px-2 py-2 text-sm text-gray-300 hover:text-white transition-colors"
                                                            >
                                                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                                </svg>
                                                                {suggestion}
                                                            </button>
                                                        ))}
                                                    </div>
                                                </div>
                                            )}
                                        </div>
                                    ) : (
                                        <div className="px-4 py-8 text-sm text-center text-gray-400">
                                            <svg className="w-12 h-12 mx-auto mb-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p>Không tìm thấy kết quả cho "{searchQuery}"</p>
                                        </div>
                                    )}
                                </div>
                            )}
                        </div>

                        {/* Heart/Wishlist Icon */}
                        <div className="relative" ref={wishlistRef}>
                            <button 
                                onClick={() => setIsWishlistOpen(!isWishlistOpen)}
                                className={`p-0 relative hover:text-[#ff4500] transition-colors duration-300 ${
                                    isHomePage && !isScrolled ? 'text-white' : 'text-gray-800'
                                }`}
                                aria-label="Wishlist"
                            >
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    className="h-6 w-6" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke="currentColor"
                                    strokeWidth={2}
                                >
                                    <path 
                                        strokeLinecap="round" 
                                        strokeLinejoin="round" 
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" 
                                    />
                                </svg>
                                {wishlistCount > 0 && (
                                    <span className="absolute -top-2 -right-2 bg-[#ff4500] text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-semibold">
                                        {wishlistCount}
                                    </span>
                                )}
                            </button>

                            {/* Wishlist Dropdown */}
                            {isWishlistOpen && (
                                <div className="absolute top-full right-0 mt-2 w-80 rounded-xl shadow-2xl border bg-white border-gray-200 overflow-hidden z-50">
                                    {wishlist.length === 0 ? (
                                        <div className="px-4 py-8 text-center">
                                            <svg 
                                                xmlns="http://www.w3.org/2000/svg" 
                                                className="h-16 w-16 mx-auto text-gray-300 mb-3"
                                                fill="none" 
                                                viewBox="0 0 24 24" 
                                                stroke="currentColor"
                                            >
                                                <path 
                                                    strokeLinecap="round" 
                                                    strokeLinejoin="round" 
                                                    strokeWidth={2} 
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" 
                                                />
                                            </svg>
                                            <p className="text-sm text-gray-500">Danh sách yêu thích trống</p>
                                            <p className="text-xs text-gray-400 mt-1">Thêm sản phẩm vào danh sách yêu thích</p>
                                        </div>
                                    ) : (
                                        <div>
                                            {/* Header */}
                                            <div className="px-4 py-3 border-b border-gray-200 bg-gray-50">
                                                <h3 className="text-sm font-semibold text-gray-800">
                                                    Danh sách yêu thích ({wishlistCount})
                                                </h3>
                                            </div>
                                            
                                            {/* Wishlist Items */}
                                            <div className="max-h-96 overflow-y-auto">
                                                {wishlist.map((product) => (
                                                    <div
                                                        key={product.id}
                                                        className="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-0"
                                                    >
                                                        {/* Product Image */}
                                                        <Link
                                                            to={`/products-detail/${product.slug}`}
                                                            className="flex-shrink-0 w-16 h-16 bg-gray-100 rounded-lg overflow-hidden"
                                                            onClick={() => setIsWishlistOpen(false)}
                                                        >
                                                            {product.image ? (
                                                                <img
                                                                    src={product.image}
                                                                    alt={product.name}
                                                                    className="w-full h-full object-cover"
                                                                />
                                                            ) : (
                                                                <div className="w-full h-full flex items-center justify-center">
                                                                    <svg className="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                                    </svg>
                                                                </div>
                                                            )}
                                                        </Link>

                                                        {/* Product Info */}
                                                        <div className="flex-1 min-w-0">
                                                            <Link
                                                                to={`/products-detail/${product.slug}`}
                                                                className="block"
                                                                onClick={() => setIsWishlistOpen(false)}
                                                            >
                                                                <h4 className="text-sm font-medium text-gray-900 truncate hover:text-[#ff4500] transition-colors">
                                                                    {product.name}
                                                                </h4>
                                                                {product.category && (
                                                                    <p className="text-xs text-gray-500 mt-1">
                                                                        {product.category}
                                                                    </p>
                                                                )}
                                                            </Link>
                                                        </div>

                                                        {/* Remove Button */}
                                                        <button
                                                            onClick={() => removeFromWishlist(product.id)}
                                                            className="flex-shrink-0 p-1 text-gray-400 hover:text-red-500 transition-colors"
                                                            aria-label="Remove from wishlist"
                                                        >
                                                            <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                ))}
                                            </div>
                                        </div>
                                    )}
                                </div>
                            )}
                        </div>

                        {/* Mobile Menu Button */}
                        <button 
                            onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
                            className={`p-0 md:hidden hover:text-[#ff4500] transition-colors duration-300 ${
                                isHomePage && !isScrolled ? 'text-white' : 'text-gray-800'
                            }`}
                            aria-label="Menu"
                        >
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                className="h-6 w-6" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke="currentColor"
                                strokeWidth={2}
                            >
                                <path 
                                    strokeLinecap="round" 
                                    strokeLinejoin="round" 
                                    d="M4 6h16M4 12h16M4 18h16" 
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        {/* Overlay when mobile menu is open - OUTSIDE header */}
        {isMobileMenuOpen && (
            <div
                className="fixed inset-0 bg-black/50 z-[55] md:hidden"
                onClick={() => setIsMobileMenuOpen(false)}
            />
        )}

        {/* Mobile Menu Sidebar - OUTSIDE header */}
        <div
            ref={mobileMenuRef}
            className={`fixed top-0 right-0 h-full w-64 bg-white shadow-2xl z-[60] transform transition-transform duration-300 ease-in-out md:hidden ${
                isMobileMenuOpen ? 'translate-x-0' : 'translate-x-full'
            }`}
        >
            {/* Close Button */}
            <div className="flex justify-between items-center p-6 border-b border-gray-200">
                <h2 className="text-lg font-semibold text-gray-800">Menu</h2>
                <button
                    onClick={() => setIsMobileMenuOpen(false)}
                    className="p-1 text-gray-600 hover:text-gray-800 transition-colors"
                    aria-label="Close menu"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {/* Menu Items */}
            <nav className="p-6">
                <Link
                    to="/about"
                    onClick={() => setIsMobileMenuOpen(false)}
                    className="block py-3 text-gray-800 hover:text-[#ff4500] font-medium transition-colors border-b border-gray-100"
                >
                    About
                </Link>
                <Link
                    to="/contact"
                    onClick={() => setIsMobileMenuOpen(false)}
                    className="block py-3 text-gray-800 hover:text-[#ff4500] font-medium transition-colors border-b border-gray-100"
                >
                    Contact
                </Link>
                <Link
                    to="/blog"
                    onClick={() => setIsMobileMenuOpen(false)}
                    className="block py-3 text-gray-800 hover:text-[#ff4500] font-medium transition-colors"
                >
                    Blog
                </Link>
            </nav>
        </div>
    </>
    );
}

export default Header;
