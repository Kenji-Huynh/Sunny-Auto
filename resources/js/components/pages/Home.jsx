import React from 'react';
import Layout from '../layout/Layout';
import PageTransition from '../layout/PageTransition';
import Hero from '../layout/Hero';
import ProductSection from '../products/ProductSection';
import CategoriesSection from '../categories/CategoriesSection';
import ServicesSection from '../services/ServicesSection';
import StatsSection from '../stats/StatsSection';
import MissionSection from '../mission/MissionSection';
import BlogSection from '../blog/BlogSection';

function Home() {
    return (
        <PageTransition>
            <Layout>
                {/* Hero Section with Video Background */}
                <Hero />

                {/* Featured Products Section */}
                <ProductSection />

                {/* Categories Section */}
                <CategoriesSection />

                {/* Services Section */}
                <ServicesSection />

                {/* Stats Section */}
                <StatsSection />

                {/* Mission/Vision Section */}
                <MissionSection />

                {/* Blog Section */}
                <BlogSection />
            </Layout>
        </PageTransition>
    );
}

export default Home;
