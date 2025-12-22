import React from 'react';
import { BrowserRouter as Router, Routes, Route, useLocation } from 'react-router-dom';
import { AnimatePresence } from 'framer-motion';
import { WishlistProvider } from './context/WishlistContext';
import Home from './pages/Home';
import ProductDetail from './pages/ProductDetail';
import Products from './pages/Products';
import Blog from './pages/Blog';
import BlogDetail from './pages/BlogDetail';
import Contact from './pages/Contact';
import About from './pages/About';
import PrivacyPolicy from './pages/PrivacyPolicy';
import CookiePolicy from './pages/CookiePolicy';

function AnimatedRoutes() {
    const location = useLocation();
    
    return (
        <AnimatePresence mode="wait">
            <Routes location={location} key={location.pathname}>
                <Route path="/" element={<Home />} />
                <Route path="/about" element={<About />} />
                <Route path="/shop" element={<Products />} />
                <Route path="/products-detail/:slug" element={<ProductDetail />} />
                <Route path="/blog" element={<Blog />} />
                <Route path="/blog/:slug" element={<BlogDetail />} />
                <Route path="/contact" element={<Contact />} />
                <Route path="/privacy-policy" element={<PrivacyPolicy />} />
                <Route path="/cookie-policy" element={<CookiePolicy />} />
            </Routes>
        </AnimatePresence>
    );
}

function App() {
    return (
        <WishlistProvider>
            <Router>
                <div className="app">
                    <AnimatedRoutes />
                </div>
            </Router>
        </WishlistProvider>
    );
}

export default App;
