import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import axios from 'axios';

const CategoriesSection = () => {
    const [categories, setCategories] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchCategories();
    }, []);

    const fetchCategories = async () => {
        try {
            const response = await axios.get('/api/categories');
            setCategories(response.data);
            setLoading(false);
        } catch (error) {
            console.error('Error fetching categories:', error);
            setLoading(false);
        }
    };

    const getCategoryImage = (slug) => {
        const imageMap = {
            'he-thong-tram-sac': '/imgs/products/thumbnail-station.jpg',
            'xe-tai-dien': '/imgs/products/thumbnail-electric-truck.jpg',
            'light-truck': '/imgs/products/thumbnail-electric-truck.jpg',
        };
        return imageMap[slug] || '/imgs/products/thumbnail-electric-truck.jpg';
    };

    if (loading) {
        return (
            <div className="py-20 bg-gray-50">
                <div className="container mx-auto px-4 text-center">
                    <p className="text-gray-600">Đang tải...</p>
                </div>
            </div>
        );
    }

    return (
        <section className="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-100">
            <div className="container mx-auto px-4">
                {/* Header */}
                <div className="text-center mb-16">
                    <h3 className="text-sm font-semibold text-orange-600 uppercase tracking-wider mb-3">
                        EXPLORE OUR FLEET
                    </h3>
                    <h2 className="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Electric Vehicle Categories
                    </h2>
                    <p className="text-lg text-gray-600 max-w-3xl mx-auto">
                        Discover our range of zero-emission electric vehicles designed for every lifestyle and need.
                    </p>
                </div>

                {/* Categories Grid */}
                <div className="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
                    {categories.map((category) => (
                        <Link
                            to={`/shop?category=${category.slug}`}
                            key={category.id}
                            className="group relative overflow-hidden rounded-3xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                        >
                            {/* Image Container */}
                            <div className="relative h-80 overflow-hidden">
                                <img
                                    src={getCategoryImage(category.slug)}
                                    alt={category.name}
                                    className="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700"
                                />
                                {/* Gradient Overlay */}
                                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-90 group-hover:opacity-95 transition-opacity duration-500"></div>
                            </div>

                            {/* Content Overlay */}
                            <div className="absolute inset-0 flex flex-col justify-end p-8 text-white">
                                {/* Category Name */}
                                <h3 className="text-3xl md:text-4xl font-bold mb-3 transform group-hover:translate-y-[-4px] transition-transform duration-500">
                                    {category.name}
                                </h3>

                                {/* Description */}
                                {category.description && (
                                    <p className="text-gray-200 text-sm md:text-base mb-4 line-clamp-2 opacity-90 group-hover:opacity-100 transition-opacity duration-500">
                                        {category.description}
                                    </p>
                                )}

                                {/* Product Count */}
                                <div className="flex items-center justify-between">
                                    <span className="text-emerald-400 font-semibold text-lg">
                                        {category.products_count}+ products
                                    </span>
                                    
                                    {/* Arrow Icon */}
                                    <div className="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm flex items-center justify-center group-hover:bg-orange-500 transition-colors duration-300">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            strokeWidth={2}
                                            stroke="currentColor"
                                            className="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                        >
                                            <path strokeLinecap="round" strokeLinejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            {/* Decorative Corner Element */}
                            <div className="absolute top-6 right-6 w-16 h-16 border-t-2 border-r-2 border-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        </Link>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default CategoriesSection;
