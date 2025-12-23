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
import { FadeInSection } from '../animation';

function Home() {
    return (
        <PageTransition>
            <Layout>
                {/* Hero Section with Video Background (no animation) */}
                <Hero />

                {/* Featured Products Section - fade from bottom */}
                <FadeInSection direction="up" delay={0.1}>
                    <ProductSection />
                </FadeInSection>

                {/* Categories Section - fade from bottom */}
                <FadeInSection direction="up" delay={0.1}>
                    <CategoriesSection />
                </FadeInSection>

                {/* Services Section - fade from bottom */}
                <FadeInSection direction="up" delay={0.1}>
                    <ServicesSection />
                </FadeInSection>

                {/* Stats Section - fade from bottom */}
                <FadeInSection direction="up" delay={0.1}>
                    <StatsSection />
                </FadeInSection>

                {/* Mission/Vision Section - fade from bottom */}
                <FadeInSection direction="up" delay={0.1}>
                    <MissionSection />
                </FadeInSection>

                {/* Blog Section - fade from bottom */}
                <FadeInSection direction="up" delay={0.1}>
                    <BlogSection />
                </FadeInSection>
            </Layout>
        </PageTransition>
    );
}

export default Home;
