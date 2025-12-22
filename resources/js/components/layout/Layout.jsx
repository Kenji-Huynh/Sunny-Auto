import React from 'react';
import Header from './Header';
import Footer from './Footer';
import PageTransition from './PageTransition';

function Layout({ children }) {
    return (
        <div className="min-h-screen">
            <Header />
            <PageTransition>
                <main>
                    {children}
                </main>
            </PageTransition>
            <Footer />
        </div>
    );
}

export default Layout;
