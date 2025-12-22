import React from 'react';

function ServicesSection() {
    const services = [
        {
            id: 1,
            title: 'OTA (Over-the-Air Updates)',
            description: 'Seamless software updates delivered wirelessly, continuously improving vehicle performance, features, and user experience without service visits.',
            image: '/imgs/products/services-1.jpg',
            icon: (
                <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                </svg>
            )
        },
        {
            id: 2,
            title: 'SUNNY PILOT ASSIST',
            description: 'Intelligent driver assistance system supporting lane keeping, adaptive navigation, and enhanced driving safety in urban and highway conditions.',
            image: '/imgs/products/services-2.jpg',
            icon: (
                <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            )
        },
        {
            id: 3,
            title: 'Sunnysmart OS',
            description: 'Advanced in-vehicle infotainment system with an intuitive interface, smart connectivity, and smooth interaction between driver, vehicle, and digital services.',
            image: '/imgs/products/services-3.png',
            icon: (
                <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            )
        },
        {
            id: 4,
            title: 'Smart Energy Management',
            description: 'Intelligent battery and power management optimizing driving range, charging efficiency, and battery lifespan through real-time monitoring and adaptive control.',
            image: '/imgs/products/services-4.png',
            icon: (
                <svg className="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            )
        }
    ];

    return (
        <section className="py-20 bg-gradient-to-b from-white via-orange-50/30 to-white">
            <div className="max-w-7xl mx-auto px-4 md:px-6 lg:px-8">
                {/* Header */}
                <div className="text-center mb-16">
                    <span className="inline-block px-4 py-2 text-sm font-semibold text-emerald-700 bg-emerald-100 rounded-full mb-4">
                        WHAT WE DO
                    </span>
                    <h2 className="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Services We Offer
                    </h2>
                    <div className="flex items-center justify-center gap-2 mb-6">
                        <div className="h-1 w-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded"></div>
                        <div className="h-1 w-12 bg-gradient-to-r from-emerald-400 to-orange-500 rounded"></div>
                        <div className="h-1 w-12 bg-gradient-to-r from-orange-500 to-orange-600 rounded"></div>
                    </div>
                    <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                        Cutting-edge technology powering the future of electric commercial vehicles
                    </p>
                </div>

                {/* Services Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {services.map((service, index) => (
                        <div 
                            key={service.id}
                            className="group relative bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden"
                        >
                            {/* Image Container */}
                            <div className="relative h-64 overflow-hidden">
                                <img 
                                    src={service.image}
                                    alt={service.title}
                                    className="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                />
                                {/* Gradient Overlay */}
                                <div className="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/40 to-transparent"></div>
                                
                                {/* Icon Badge */}
                                <div className="absolute top-6 left-6 w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-orange-600 shadow-xl group-hover:scale-110 transition-transform duration-300">
                                    {service.icon}
                                </div>

                                {/* Number Badge */}
                                <div className="absolute top-6 right-6 w-12 h-12 bg-orange-600 rounded-full flex items-center justify-center text-white font-bold text-lg shadow-xl">
                                    {String(index + 1).padStart(2, '0')}
                                </div>
                            </div>

                            {/* Content */}
                            <div className="p-8">
                                <h3 className="text-2xl font-bold text-gray-900 mb-4 group-hover:text-orange-600 transition-colors">
                                    {service.title}
                                </h3>
                                <p className="text-gray-600 leading-relaxed mb-6">
                                    {service.description}
                                </p>
                                
                                {/* Learn More Button */}
                                <button className="inline-flex items-center gap-2 text-orange-600 font-semibold group-hover:gap-4 transition-all duration-300">
                                    <span>Learn More</span>
                                    <svg className="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </button>
                            </div>

                            {/* Decorative Element */}
                            <div className="absolute bottom-0 right-0 w-32 h-32 bg-gradient-to-tl from-emerald-100/50 to-transparent rounded-tl-full transform translate-x-16 translate-y-16 group-hover:translate-x-12 group-hover:translate-y-12 transition-transform duration-500"></div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
}

export default ServicesSection;
