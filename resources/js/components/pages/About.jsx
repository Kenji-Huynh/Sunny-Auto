import React from 'react';
import Layout from '../layout/Layout';

function About() {
    return (
        <Layout>
            {/* Hero Section */}
            <section 
                className="relative min-h-[500px] flex items-center justify-center bg-cover bg-center"
                style={{ backgroundImage: 'url(/imgs/products/about.jpg)' }}
            >
                {/* Overlay */}
                <div className="absolute inset-0 bg-[#1a2332]/90"></div>
                
                {/* Content */}
                <div className="relative z-10 container mx-auto px-4 py-20 text-center">
                    <h1 className="text-5xl md:text-6xl font-bold text-white mb-8">
                        About Us
                    </h1>
                    <p className="text-lg md:text-xl text-gray-200 max-w-4xl mx-auto leading-relaxed">
                        Established under the esteemed umbrella of Leong Lee International 
                        Limited, SUNNY AUTO emerges as a pioneering solution provider in the 
                        realm of transportation and equipment, specializing in serving the 
                        industrial and logistics sectors.
                    </p>
                </div>
            </section>

            {/* Mission Section */}
            <section className="py-20 bg-gradient-to-b from-white to-gray-50">
                <div className="container mx-auto px-4">
                    <div className="max-w-5xl mx-auto">
                        {/* Main Content Box */}
                        <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 border-l-4 border-orange-500">
                            <div className="flex items-start gap-6 mb-8">
                                <div className="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg className="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div className="flex-1">
                                    <h2 className="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                                        Driving the Future
                                    </h2>
                                    <div className="w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-300"></div>
                                </div>
                            </div>

                            <div className="space-y-6">
                                <p className="text-lg md:text-xl text-gray-700 leading-relaxed">
                                    As a <span className="font-semibold text-gray-900">prominent member of the Leong Lee Group</span>, 
                                    SUNNY AUTO is driven by a steadfast commitment to <span className="text-orange-600 font-medium">innovation</span>, 
                                    <span className="text-orange-600 font-medium"> sustainability</span>, and 
                                    <span className="text-blue-600 font-medium"> unparalleled service excellence</span>.
                                </p>
                                
                                <p className="text-lg md:text-xl text-gray-700 leading-relaxed">
                                    At SUNNY AUTO, our primary focus lies in the <span className="font-semibold text-gray-900">dynamic landscape of electric vehicles (EVs)</span>, 
                                    where we harness cutting-edge technology to deliver next-generation solutions.
                                </p>

                                <div className="bg-gradient-to-r from-orange-50 to-orange-100/50 rounded-xl p-6 border-l-4 border-orange-400">
                                    <p className="text-lg md:text-xl text-gray-800 leading-relaxed">
                                        With an unwavering dedication to advancing the EV segment, we proudly offer a 
                                        <span className="font-semibold text-gray-900"> comprehensive range of EV products</span>, including:
                                    </p>
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                        <div className="flex items-center gap-3">
                                            <div className="w-2 h-2 bg-orange-500 rounded-full"></div>
                                            <span className="text-gray-800 font-medium">Electric Trucks</span>
                                        </div>
                                        <div className="flex items-center gap-3">
                                            <div className="w-2 h-2 bg-orange-500 rounded-full"></div>
                                            <span className="text-gray-800 font-medium">Electric Forklifts</span>
                                        </div>
                                        <div className="flex items-center gap-3">
                                            <div className="w-2 h-2 bg-orange-500 rounded-full"></div>
                                            <span className="text-gray-800 font-medium">Charging Station Systems</span>
                                        </div>
                                        <div className="flex items-center gap-3">
                                            <div className="w-2 h-2 bg-orange-500 rounded-full"></div>
                                            <span className="text-gray-800 font-medium">Battery Solutions</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Vision & Mission Section */}
            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-4">
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-6xl mx-auto">
                        {/* Our Vision */}
                        <div className="bg-gradient-to-br from-orange-50 to-orange-50 rounded-2xl p-8 shadow-md hover:shadow-xl transition-all">
                            <div className="flex items-center gap-4 mb-6">
                                <div className="w-14 h-14 bg-orange-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg className="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </div>
                                <h3 className="text-2xl font-bold text-gray-900">OUR VISION</h3>
                            </div>
                            <p className="text-gray-700 leading-relaxed">
                                To pioneer innovative logistics solutions, providing cutting-edge, sustainable 
                                transportation and services that meet client needs and contribute to a greener planet.
                            </p>
                        </div>

                        {/* Our Mission */}
                        <div className="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 shadow-md hover:shadow-xl transition-all">
                            <div className="flex items-center gap-4 mb-6">
                                <div className="w-14 h-14 bg-[#1a2332] rounded-xl flex items-center justify-center shadow-lg">
                                    <svg className="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <h3 className="text-2xl font-bold text-gray-900">OUR MISSION</h3>
                            </div>
                            <p className="text-gray-700 leading-relaxed">
                                Leading the electric vehicle revolution with efficient, eco-friendly, and accessible 
                                transportation solutions, we aim to create a sustainable future for all.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Our Product Range Section */}
            <section className="py-20 bg-white">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-16">
                        <h2 className="text-4xl font-bold text-gray-900 mb-4">
                            Our Product Range
                        </h2>
                        <p className="text-gray-600">
                            Comprehensive EV solutions for industrial and logistics sectors
                        </p>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                        {/* Electric Trucks */}
                        <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-100">
                            <div className="w-16 h-16 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                                <svg className="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-2">Electric Trucks</h3>
                            <p className="text-gray-600 text-sm">
                                Heavy-duty electric trucks designed for industrial and logistics operations
                            </p>
                        </div>

                        {/* Electric Forklifts */}
                        <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-100">
                            <div className="w-16 h-16 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                                <svg className="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-2">Electric Forklifts</h3>
                            <p className="text-gray-600 text-sm">
                                State-of-the-art electric forklifts for warehouse and material handling
                            </p>
                        </div>

                        {/* Charging Stations */}
                        <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-100">
                            <div className="w-16 h-16 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                                <svg className="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-2">Charging Stations</h3>
                            <p className="text-gray-600 text-sm">
                                Advanced charging station systems for efficient EV infrastructure
                            </p>
                        </div>

                        {/* Battery Solutions */}
                        <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all border border-gray-100">
                            <div className="w-16 h-16 bg-orange-50 rounded-xl flex items-center justify-center mb-4">
                                <svg className="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-gray-900 mb-2">Battery Solutions</h3>
                            <p className="text-gray-600 text-sm">
                                Diverse array of battery types for various industrial applications
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Values Section */}
            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-4">
                    <h2 className="text-4xl font-bold text-center mb-16 text-gray-900">
                        Our Core Values
                    </h2>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                        {/* Innovation */}
                        <div className="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition-shadow">
                            <div className="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                                <svg className="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-center mb-4 text-gray-900">Innovation</h3>
                            <p className="text-gray-600 text-center">
                                Continuously pushing boundaries with cutting-edge technology and next-generation solutions.
                            </p>
                        </div>

                        {/* Sustainability */}
                        <div className="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition-shadow">
                            <div className="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                                <svg className="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-center mb-4 text-gray-900">Sustainability</h3>
                            <p className="text-gray-600 text-center">
                                Committed to environmental responsibility through electric vehicle solutions.
                            </p>
                        </div>

                        {/* Excellence */}
                        <div className="bg-white rounded-xl p-8 shadow-md hover:shadow-xl transition-shadow">
                            <div className="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mb-6 mx-auto">
                                <svg className="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <h3 className="text-xl font-bold text-center mb-4 text-gray-900">Excellence</h3>
                            <p className="text-gray-600 text-center">
                                Delivering unparalleled service and quality in every product and interaction.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Global Footprint & Diverse Talent Base Section */}
            <section className="py-20 bg-gradient-to-b from-white to-gray-50">
                <div className="container mx-auto px-4">
                    <div className="max-w-6xl mx-auto">
                        {/* Section Header */}
                        <div className="text-center mb-12">
                            <h2 className="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                                Global Footprint & Diverse Talent Base
                            </h2>
                            <p className="text-lg text-gray-600 max-w-4xl mx-auto leading-relaxed">
                                We are supported by a team of passionate, diverse, and talented employees with 
                                experience across the technology, finance, and automotive industry working across 
                                hubs in Vietnam, China, and Southeast Asia. Together, we are building our international 
                                presence as the explorer of future mobility.
                            </p>
                        </div>

                        {/* Smart Manufacturing Card */}
                        <div className="bg-white rounded-2xl shadow-lg p-8 md:p-12 border-t-4 border-orange-500">
                            <div className="flex items-start gap-6 mb-6">
                                <div className="flex-shrink-0 w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center">
                                    <svg className="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 className="text-3xl font-bold text-gray-900 mb-2">
                                        Smart Manufacturing
                                    </h3>
                                    <div className="w-20 h-1 bg-gradient-to-r from-orange-500 to-orange-300"></div>
                                </div>
                            </div>

                            <div className="space-y-4">
                                <p className="text-gray-700 leading-relaxed">
                                    Built to Industrial 4.0 standards with a sustainable philosophy, our self-built facilities 
                                    are equipped with advanced automation for assembly and battery pack production - open and 
                                    transparent, with real-time monitoring to ensure quality and efficiency.
                                </p>
                                <p className="text-gray-700 leading-relaxed">
                                    Our maximum designed future production capacity could reach 100,000 cars annually with smart 
                                    factories in Ho Chi Minh City and Hanoi.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* ESG Commitment Section */}
            <section className="py-20 bg-gradient-to-b from-orange-50 to-white">
                <div className="container mx-auto px-4">
                    <div className="max-w-6xl mx-auto">
                        {/* Section Header with Icon */}
                        <div className="text-center mb-12">
                            <div className="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg className="w-10 h-10 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <h2 className="text-4xl md:text-5xl font-bold text-gray-900 mb-6">
                                ESG Commitment
                            </h2>
                            <p className="text-lg text-gray-600 max-w-4xl mx-auto leading-relaxed">
                                As part of our commitment to ESG, we have curated an innovative core concept of S-SEG 
                                (Smart, Sustainable and Green) that guides the establishment and operations of our 
                                factories and underpins all major aspects of our business operations.
                            </p>
                        </div>

                        {/* ESG Cards Grid */}
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            {/* Zero-emission vehicle production */}
                            <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
                                <div className="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                                    <svg className="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">
                                    Zero-emission vehicle production
                                </h3>
                            </div>

                            {/* Carbon-neutral operations */}
                            <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
                                <div className="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                                    <svg className="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">
                                    Carbon-neutral operations
                                </h3>
                            </div>

                            {/* Sustainable supply chain */}
                            <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
                                <div className="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                                    <svg className="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">
                                    Sustainable supply chain
                                </h3>
                            </div>

                            {/* Community engagement programs */}
                            <div className="bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all">
                                <div className="w-14 h-14 bg-orange-100 rounded-full flex items-center justify-center mb-4">
                                    <svg className="w-7 h-7 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">
                                    Community engagement programs
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {/* UN SDG Adoption Section */}
            <section className="py-20 bg-white">
                <div className="container mx-auto px-4">
                    <div className="max-w-4xl mx-auto text-center mb-12">
                        <h2 className="text-4xl md:text-5xl font-bold text-gray-900 mb-6">UN SDG ADOPTION</h2>
                        <p className="text-lg text-gray-700 max-w-2xl mx-auto leading-relaxed">
                            As a company that cares, our contribution to the UN Sustainable Development Goals (SDGs) is integrated into our strategies across our business value chain. Based on prioritization, 8 SDGs most relevant to the business have been highlighted with objective to both increase positive impact and reduce negative impact from business operations
                        </p>
                    </div>
                    <div className="flex justify-center mb-8">
                        <img src="/imgs/goals.png" alt="UN SDG Goals" className="max-w-full h-auto rounded-xl shadow-lg" style={{maxWidth: '700px'}} />
                    </div>
                </div>
            </section>

            {/* Timeline Section */}
            <section className="py-20 bg-white">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-16">
                        <h2 className="text-4xl font-bold text-gray-900 mb-4">
                            About SUNNY AUTO
                        </h2>
                        <p className="text-gray-600 max-w-3xl mx-auto">
                            Established under the esteemed umbrella of Leong Lee International Limited, SUNNY AUTO emerges 
                            as a pioneering solution provider in the realm of transportation and equipment, specializing in 
                            serving the industrial and logistics sectors. As a prominent member of the Leong Lee Group, we are 
                            driven by a steadfast commitment to innovation, sustainability, and unparalleled service excellence.
                        </p>
                    </div>

                    {/* Timeline */}
                    <div className="max-w-6xl mx-auto">
                        <div className="grid grid-cols-1 md:grid-cols-5 gap-8">
                            {/* 2020 */}
                            <div className="text-center">
                                <div className="relative">
                                    {/* Connector Line - Hidden on mobile, shown on md+ */}
                                    <div className="hidden md:block absolute top-10 left-1/2 w-full h-0.5 bg-green-200 -z-10"></div>
                                    <div className="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg relative z-10">
                                        <span className="text-2xl font-bold text-white">2020</span>
                                    </div>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Company Founded</h3>
                                <p className="text-sm text-gray-600">
                                    SUNNY AUTO established as part of Leong Lee Group
                                </p>
                            </div>

                            {/* 2021 */}
                            <div className="text-center">
                                <div className="relative">
                                    <div className="hidden md:block absolute top-10 left-1/2 w-full h-0.5 bg-green-200 -z-10"></div>
                                    <div className="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg relative z-10">
                                        <span className="text-2xl font-bold text-white">2021</span>
                                    </div>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">First EV Products</h3>
                                <p className="text-sm text-gray-600">
                                    Launched our first electric vehicle product line
                                </p>
                            </div>

                            {/* 2022 */}
                            <div className="text-center">
                                <div className="relative">
                                    <div className="hidden md:block absolute top-10 left-1/2 w-full h-0.5 bg-green-200 -z-10"></div>
                                    <div className="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg relative z-10">
                                        <span className="text-2xl font-bold text-white">2022</span>
                                    </div>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Industrial Expansion</h3>
                                <p className="text-sm text-gray-600">
                                    Expanded into industrial equipment sector
                                </p>
                            </div>

                            {/* 2023 */}
                            <div className="text-center">
                                <div className="relative">
                                    <div className="hidden md:block absolute top-10 left-1/2 w-full h-0.5 bg-green-200 -z-10"></div>
                                    <div className="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg relative z-10">
                                        <span className="text-2xl font-bold text-white">2023</span>
                                    </div>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Logistics Solutions</h3>
                                <p className="text-sm text-gray-600">
                                    Introduced comprehensive logistics solutions
                                </p>
                            </div>

                            {/* 2024 */}
                            <div className="text-center">
                                <div className="relative">
                                    <div className="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg relative z-10">
                                        <span className="text-2xl font-bold text-white">2024</span>
                                    </div>
                                </div>
                                <h3 className="text-lg font-bold text-gray-900 mb-2">Market Leadership</h3>
                                <p className="text-sm text-gray-600">
                                    Achieved market leadership in EV solutions
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Core Management Team Section */}
            <section className="py-20 bg-gray-50">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-16">
                        <h2 className="text-4xl font-bold text-gray-900 mb-4">
                            Core Management Team
                        </h2>
                        <p className="text-gray-600 max-w-3xl mx-auto">
                            Sunny Auto boasts unique DNA with a strong and diverse management team.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
                        {/* Dr. Phuoc - Chairman & CEO */}
                        <div className="text-center">
                            <div className="relative mb-6">
                                <div className="w-40 h-40 mx-auto rounded-full overflow-hidden bg-orange-100 shadow-lg">
                                    <img 
                                        src="/imgs/people/3.jpg" 
                                        alt="Dr. Phuoc" 
                                        className="w-full h-full object-cover"
                                    />
                                </div>
                            </div>
                            <h3 className="text-2xl font-bold text-gray-900 mb-2">Dr. Phuoc</h3>
                            <p className="text-orange-600 font-semibold mb-4">Chairman & CEO</p>
                            <p className="text-gray-600 leading-relaxed">
                                Responsible for the overall strategic planning, organizational development, and management operations.
                            </p>
                        </div>

                        {/* Tran Minh Duc - President */}
                        <div className="text-center">
                            <div className="relative mb-6">
                                <div className="w-40 h-40 mx-auto rounded-full overflow-hidden bg-orange-100 shadow-lg">
                                    <img 
                                        src="/imgs/people/2.jpg" 
                                        alt="Tran Minh Duc" 
                                        className="w-full h-full object-cover"
                                    />
                                </div>
                            </div>
                            <h3 className="text-2xl font-bold text-gray-900 mb-2">Tran Minh Duc</h3>
                            <p className="text-orange-600 font-semibold mb-4">President</p>
                            <p className="text-gray-600 leading-relaxed">
                                Responsible for the company's product planning, product portfolio management and sales operations.
                            </p>
                        </div>

                        {/* Le Thi Mai - Vice President */}
                        <div className="text-center">
                            <div className="relative mb-6">
                                <div className="w-40 h-40 mx-auto rounded-full overflow-hidden bg-orange-100 shadow-lg">
                                    <img 
                                        src="/imgs/people/1.jpg" 
                                        alt="Le Thi Mai" 
                                        className="w-full h-full object-cover"
                                    />
                                </div>
                            </div>
                            <h3 className="text-2xl font-bold text-gray-900 mb-2">Le Thi Mai</h3>
                            <p className="text-orange-600 font-semibold mb-4">Vice President</p>
                            <p className="text-gray-600 leading-relaxed">
                                Responsible for the company's strategy, finance, fundraising, investments, and globalization efforts.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="py-20 bg-gradient-to-r from-orange-500 to-orange-600">
                <div className="container mx-auto px-4 text-center">
                    <h2 className="text-3xl md:text-4xl font-bold text-white mb-6">
                        Ready to Transform Your Fleet?
                    </h2>
                    <p className="text-lg text-white/90 mb-8 max-w-2xl mx-auto">
                        Join the electric revolution with SUNNY AUTO's comprehensive EV solutions
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center">
                        <a 
                            href="/shop" 
                            className="bg-white text-orange-600 px-8 py-4 rounded-full font-semibold hover:bg-gray-100 transition-colors"
                        >
                            View Products
                        </a>
                        <a 
                            href="/contact" 
                            className="bg-transparent border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-orange-600 transition-colors"
                        >
                            Contact Us
                        </a>
                    </div>
                </div>
            </section>
        </Layout>
    );
}

export default About;
