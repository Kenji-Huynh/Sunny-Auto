import React, { useState, useEffect, useRef } from 'react';

function StatsSection() {
    const [isVisible, setIsVisible] = useState(false);
    const sectionRef = useRef(null);

    const stats = [
        {
            id: 1,
            icon: (
                <svg className="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            ),
            target: 5000,
            suffix: 'K',
            label: 'EVs Delivered'
        },
        {
            id: 2,
            icon: (
                <svg className="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
            ),
            target: 10000,
            suffix: '+',
            label: 'Charging Stations'
        },
        {
            id: 3,
            icon: (
                <svg className="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            ),
            target: 500,
            suffix: 'K+',
            label: 'Tons CO₂ Saved'
        },
        {
            id: 4,
            icon: (
                <svg className="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            ),
            target: 100,
            suffix: 'K+',
            label: 'Happy Owners'
        }
    ];

    useEffect(() => {
        const observer = new IntersectionObserver(
            ([entry]) => {
                if (entry.isIntersecting) {
                    setIsVisible(true);
                }
            },
            { threshold: 0.3 }
        );

        if (sectionRef.current) {
            observer.observe(sectionRef.current);
        }

        return () => {
            if (sectionRef.current) {
                observer.unobserve(sectionRef.current);
            }
        };
    }, []);

    return (
        <section 
            ref={sectionRef}
            className="py-20 bg-gradient-to-r from-[#0a1929] via-[#0d2438] to-[#0f3a49] relative overflow-hidden"
        >
            {/* Decorative Elements */}
            <div className="absolute inset-0 opacity-10">
                <div className="absolute top-0 left-0 w-96 h-96 bg-teal-500 rounded-full blur-3xl"></div>
                <div className="absolute bottom-0 right-0 w-96 h-96 bg-orange-500 rounded-full blur-3xl"></div>
            </div>

            <div className="max-w-7xl mx-auto px-4 md:px-6 lg:px-8 relative z-10">
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    {stats.map((stat) => (
                        <StatCard 
                            key={stat.id} 
                            stat={stat} 
                            isVisible={isVisible}
                        />
                    ))}
                </div>
            </div>
        </section>
    );
}

function StatCard({ stat, isVisible }) {
    const [count, setCount] = useState(0);

    useEffect(() => {
        if (!isVisible) return;

        const duration = 2000; // 2 seconds
        const steps = 60;
        const increment = stat.target / steps;
        const stepDuration = duration / steps;
        let currentStep = 0;

        const timer = setInterval(() => {
            currentStep++;
            if (currentStep === steps) {
                setCount(stat.target);
                clearInterval(timer);
            } else {
                setCount(Math.floor(increment * currentStep));
            }
        }, stepDuration);

        return () => clearInterval(timer);
    }, [isVisible, stat.target]);

    return (
        <div className="text-center group">
            {/* Icon */}
            <div className="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-gradient-to-br from-teal-500/20 to-orange-500/20 backdrop-blur-sm border border-teal-500/30 text-teal-400 mb-6 group-hover:scale-110 transition-transform duration-300">
                {stat.icon}
            </div>

            {/* Number */}
            <div className="mb-3">
                <span className="text-5xl md:text-6xl font-bold text-white tracking-tight">
                    {count.toLocaleString()}
                </span>
                <span className="text-5xl md:text-6xl font-bold text-teal-400">
                    {stat.suffix}
                </span>
            </div>

            {/* Label */}
            <p className="text-lg text-gray-300 font-medium">
                {stat.label}
            </p>
        </div>
    );
}

export default StatsSection;
