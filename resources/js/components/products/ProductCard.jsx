import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { useWishlist } from '../context/WishlistContext';

function ProductCard({ product, isLarge = false }) {
    const [isHovered, setIsHovered] = useState(false);
    const { addToWishlist, removeFromWishlist, isInWishlist } = useWishlist();
    const inWishlist = isInWishlist(product.id);

    const handleWishlistClick = (e) => {
        e.preventDefault();
        e.stopPropagation();
        
        if (inWishlist) {
            removeFromWishlist(product.id);
        } else {
            addToWishlist({
                id: product.id,
                name: product.name,
                slug: product.slug,
                image: product.primary_image || '/imgs/products/placeholder.jpg',
                category: product.category?.name || product.brand?.name
            });
        }
    };

    // Get product specs
    const evcSpec = product.evc_spec || {};
    const brand = product.brand || {};

    return (
        <div className="group relative max-w-2xl mx-auto transform transition-all duration-300 hover:scale-[1.02]">
            <Link to={`/products-detail/${product.slug}`}>
                <div className="transition-all duration-300 hover:shadow-2xl">
                    {/* Image Container with Overlay */}
                    <div 
                        className="relative aspect-[4/3] overflow-hidden"
                        onMouseEnter={() => setIsHovered(true)}
                        onMouseLeave={() => setIsHovered(false)}
                    >
                        {/* Wishlist Heart Button */}
                        <button
                            onClick={handleWishlistClick}
                            className="absolute top-3 right-3 z-40 p-2 rounded-full bg-white/90 backdrop-blur-sm shadow-lg hover:bg-white hover:scale-110 transition-all duration-300"
                            aria-label={inWishlist ? 'Remove from wishlist' : 'Add to wishlist'}
                        >
                            <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                className="h-5 w-5" 
                                fill={inWishlist ? '#ff4500' : 'none'}
                                viewBox="0 0 24 24" 
                                stroke={inWishlist ? '#ff4500' : 'currentColor'}
                                strokeWidth={2}
                            >
                                <path 
                                    strokeLinecap="round" 
                                    strokeLinejoin="round" 
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" 
                                />
                            </svg>
                        </button>

                        {/* Product Image - will blur on hover */}
                        <img 
                            src={product.primary_image || '/imgs/products/placeholder.jpg'}
                            alt={product.name}
                            className={`w-full h-full object-contain transition-all duration-500 relative z-20 p-6 ${
                                isHovered ? 'blur-sm scale-105 opacity-30' : ''
                            }`}
                        />

                        {/* Hover Overlay with Specs */}
                        <div 
                            className={`absolute inset-0 z-30 flex items-center justify-center p-3 transition-all duration-500 ${
                                isHovered ? 'opacity-100' : 'opacity-0 pointer-events-none'
                            }`}
                        >
                            <div className="w-full max-w-md">
                                {/* Price Badge */}
                                <div className="mb-3 text-center">
                                    <div className="inline-block bg-orange-500 text-white px-4 py-1.5 rounded-lg font-bold text-sm shadow-lg">
                                        {product.formatted_price}
                                    </div>
                                </div>

                                {/* Specs Grid */}
                                <div className="grid grid-cols-2 gap-2.5 text-white">
                                    {/* Range */}
                                    {evcSpec.range_km && (
                                        <div className="bg-gray-800/90 backdrop-blur-sm rounded-lg p-2.5 border border-orange-500/30">
                                            <p className="text-emerald-400 font-bold mb-0.5 text-xs">Range</p>
                                            <p className="text-white font-medium text-sm">{evcSpec.range_km}</p>
                                            {evcSpec.range_test_standard && (
                                                <p className="text-gray-400 text-xs mt-0.5">({evcSpec.range_test_standard})</p>
                                            )}
                                        </div>
                                    )}

                                    {/* Charge */}
                                    {evcSpec.charge_description && (
                                        <div className="bg-gray-800/90 backdrop-blur-sm rounded-lg p-2.5 border border-orange-500/30">
                                            <p className="text-emerald-400 font-bold mb-0.5 text-xs">Charge</p>
                                            <p className="text-white text-xs leading-relaxed">{evcSpec.charge_description}</p>
                                        </div>
                                    )}

                                    {/* 0-100 km/h */}
                                    {evcSpec.zero_to_100_kmh && (
                                        <div className="bg-gray-800/90 backdrop-blur-sm rounded-lg p-2.5 border border-orange-500/30">
                                            <p className="text-emerald-400 font-bold mb-0.5 text-xs">0-100 km/h</p>
                                            <p className="text-white font-medium text-sm">{evcSpec.zero_to_100_kmh}</p>
                                        </div>
                                    )}

                                    {/* Power */}
                                    {(evcSpec.power_kw || evcSpec.torque_nm) && (
                                        <div className="bg-gray-800/90 backdrop-blur-sm rounded-lg p-2.5 border border-orange-500/30">
                                            <p className="text-emerald-400 font-bold mb-0.5 text-xs">Power</p>
                                            <p className="text-white font-medium text-sm">
                                                {evcSpec.power_kw}
                                            </p>
                                            {evcSpec.torque_nm && (
                                                <p className="text-gray-400 text-xs mt-0.5">({evcSpec.torque_nm})</p>
                                            )}
                                        </div>
                                    )}

                                    {/* Drivetrain */}
                                    {evcSpec.drivetrain && (
                                        <div className="bg-gray-800/90 backdrop-blur-sm rounded-lg p-2.5 border border-orange-500/30">
                                            <p className="text-emerald-400 font-bold mb-0.5 text-xs">Drivetrain</p>
                                            <p className="text-white text-xs">{evcSpec.drivetrain}</p>
                                        </div>
                                    )}

                                    {/* Battery */}
                                    {(evcSpec.battery_capacity_kwh || evcSpec.battery_type) && (
                                        <div className="bg-gray-800/90 backdrop-blur-sm rounded-lg p-2.5 border border-orange-500/30">
                                            <p className="text-emerald-400 font-bold mb-0.5 text-xs">Battery</p>
                                            <p className="text-white text-xs leading-relaxed">
                                                {evcSpec.battery_capacity_kwh}
                                                {evcSpec.battery_type && <>, {evcSpec.battery_type}</>}
                                            </p>
                                        </div>
                                    )}
                                </div>

                                {/* Brand Badge at bottom of overlay */}
                                {brand.name && (
                                    <div className="mt-3 text-center">
                                        <div className="inline-block bg-gray-900/90 backdrop-blur-sm px-4 py-1.5 rounded-lg border border-orange-500/50">
                                            <p className="text-gray-400 text-xs mb-0.5">Brand</p>
                                            <p className="text-white font-black text-base tracking-wider">{brand.name.toUpperCase()}</p>
                                        </div>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>

                    {/* Product Info Below */}
                    <div className="mt-3 text-center">
                        {product.short_description && (
                            <p className="text-gray-800 text-xs leading-relaxed line-clamp-2 max-w-md mx-auto">
                                {product.short_description}
                            </p>
                        )}
                    </div>
                </div>
            </Link>
        </div>
    );
}

export default ProductCard;
