import React from 'react';

function MissionSection() {
    return (
        <section className="relative h-screen min-h-[600px] flex items-center justify-center overflow-hidden">
            {/* Video Background */}
            <div className="absolute inset-0 w-full h-full">
                <video
                    autoPlay
                    loop
                    muted
                    playsInline
                    className="w-full h-full object-cover"
                >
                    <source src="/videos/Electric_Truck_Looping_Homepage_Video.mp4" type="video/mp4" />
                </video>
                
                {/* Gradient Overlay */}
                <div className="absolute inset-0 bg-gradient-to-b from-black/40 via-black/50 to-black/60"></div>
            </div>

            {/* Content */}
            <div className="relative z-10 max-w-5xl mx-auto px-4 md:px-6 lg:px-8 text-center">
                {/* Decorative Line */}
                <div className="flex items-center justify-center gap-4 mb-8">
                    <div className="w-16 h-[2px] bg-gradient-to-r from-transparent to-teal-400"></div>
                    <div className="w-2 h-2 rounded-full bg-teal-400"></div>
                    <div className="w-16 h-[2px] bg-gradient-to-l from-transparent to-teal-400"></div>
                </div>

                {/* Heading */}
                <h2 className="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-8 leading-tight">
                    Powering a Smarter Way to{' '}
                    <span className="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-emerald-400">
                        Move Goods
                    </span>
                </h2>

                {/* Description */}
                <div className="max-w-4xl mx-auto">
                    <p className="text-base md:text-lg text-gray-200 leading-relaxed">
                        Electric trucking is evolving. It's no longer just about carrying goods — it's about elevating efficiency, safety, and the entire logistics experience. At{' '}
                        <span className="font-semibold text-teal-400">Sunny Auto</span>, we see a tremendous opportunity for technology to transform how businesses move.
                    </p>
                    <p className="text-base md:text-lg text-gray-200 leading-relaxed mt-6">
                        We redefine trucking as a seamless extension of operations: intelligent, connected, and human-focused. Whether on short routes or long hauls, our smart electric trucks are built for a cleaner future and a more productive world. This is mobility engineered for business — efficient, sustainable, and truly intelligent.
                    </p>
                </div>

                {/* Decorative Bottom Line */}
                <div className="flex items-center justify-center gap-4 mt-12">
                    <div className="w-24 h-[1px] bg-gradient-to-r from-transparent to-teal-400/50"></div>
                    <div className="flex gap-1">
                        <div className="w-1 h-1 rounded-full bg-teal-400/50"></div>
                        <div className="w-1 h-1 rounded-full bg-teal-400"></div>
                        <div className="w-1 h-1 rounded-full bg-teal-400/50"></div>
                    </div>
                    <div className="w-24 h-[1px] bg-gradient-to-l from-transparent to-teal-400/50"></div>
                </div>

                {/* Scroll Indicator */}
                <div className="absolute bottom-4 left-1/2 -translate-x-1/2 animate-bounce">
                    <svg className="w-6 h-6 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
        </section>
    );
}

export default MissionSection;
