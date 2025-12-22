import React from 'react';
import { Link } from 'react-router-dom';

function Hero() {
    return (
        <section className="relative h-screen w-full overflow-hidden">
            {/* Video Background */}
            <div className="absolute inset-0">
                <video
                    autoPlay
                    loop
                    muted
                    playsInline
                    className="w-full h-full object-cover"
                >
                    <source src="/videos/1763350333175_00de8r56im137.mp4" type="video/mp4" />
                    Your browser does not support the video tag.
                </video>
                
                {/* Overlay gradient */}
                <div className="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
            </div>

            {/* Content */}
            <div className="relative z-10 h-full flex items-center justify-center">
                <div className="container mx-auto px-6">
                    <div className="max-w-4xl mx-auto text-center">
                        <h1 className="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                            SPECIAL-EDITION ELLIOT: ONLINE ONLY
                        </h1>
                        <p className="text-lg md:text-xl text-white/90 mb-8 leading-relaxed">
                            The Elliot in transparent light brown - available online first for a limited time. 
                            Slim, minimal, and here to celebrate World Sight Day.
                        </p>
                        <Link 
                            to="/about" 
                            className="group relative px-6 py-3 bg-[#ff4500] text-white font-semibold rounded-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-[#ff4500]/50 inline-flex items-center justify-center"
                        >
                            <span className="relative z-10 flex items-center">
                                Sunny Auto
                                <svg 
                                    xmlns="http://www.w3.org/2000/svg" 
                                    className="h-5 w-5 ml-2 transform group-hover:translate-x-1 transition-transform" 
                                    fill="none" 
                                    viewBox="0 0 24 24" 
                                    stroke="currentColor"
                                >
                                    <path 
                                        strokeLinecap="round" 
                                        strokeLinejoin="round" 
                                        strokeWidth={2} 
                                        d="M9 5l7 7-7 7" 
                                    />
                                </svg>
                            </span>
                            <div className="absolute inset-0 bg-gradient-to-r from-[#ff4500] to-[#ff6347] transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        </Link>
                    </div>
                </div>
            </div>

            {/* Scroll Indicator */}
            <div className="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
                <div className="animate-bounce">
                    <svg 
                        xmlns="http://www.w3.org/2000/svg" 
                        className="h-8 w-8 text-white opacity-75" 
                        fill="none" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path 
                            strokeLinecap="round" 
                            strokeLinejoin="round" 
                            strokeWidth={2} 
                            d="M19 14l-7 7m0 0l-7-7m7 7V3" 
                        />
                    </svg>
                </div>
            </div>
        </section>
    );
}

export default Hero;
