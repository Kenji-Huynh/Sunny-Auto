import React from 'react';
import Layout from '../layout/Layout';

function CookiePolicy() {
    return (
        <Layout>
            {/* Hero Section */}
            <section className="bg-gradient-to-r from-[#1a2332] to-gray-800 py-20">
                <div className="container mx-auto px-4">
                    <div className="max-w-4xl mx-auto text-center">
                        <h1 className="text-4xl md:text-5xl font-bold text-white mb-6">
                            Cookie Policy
                        </h1>
                        <p className="text-lg text-gray-300">
                            Last updated: December 18, 2025
                        </p>
                    </div>
                </div>
            </section>

            {/* Content Section */}
            <section className="py-16 bg-white">
                <div className="container mx-auto px-4">
                    <div className="max-w-4xl mx-auto">
                        {/* Introduction */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">What Are Cookies?</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                Cookies are small text files that are placed on your computer or mobile device when you visit a website. 
                                They are widely used to make websites work more efficiently and provide information to website owners.
                            </p>
                            <p className="text-gray-700 leading-relaxed">
                                This Cookie Policy explains how SUNNY AUTO uses cookies and similar technologies on our website, 
                                and your choices regarding these technologies.
                            </p>
                        </div>

                        {/* Types of Cookies */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Types of Cookies We Use</h2>
                            
                            {/* Strictly Necessary Cookies */}
                            <div className="bg-gray-50 rounded-xl p-6 mb-6 border-l-4 border-orange-500">
                                <h3 className="text-xl font-bold text-gray-900 mb-3 flex items-center">
                                    <svg className="w-6 h-6 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Strictly Necessary Cookies
                                </h3>
                                <p className="text-gray-700 leading-relaxed mb-3">
                                    These cookies are essential for the website to function properly. They enable basic functions like 
                                    page navigation, access to secure areas, and processing orders.
                                </p>
                                <p className="text-sm text-gray-600 italic">
                                    Examples: Session cookies, authentication cookies, load balancing cookies
                                </p>
                            </div>

                            {/* Performance Cookies */}
                            <div className="bg-gray-50 rounded-xl p-6 mb-6 border-l-4 border-blue-500">
                                <h3 className="text-xl font-bold text-gray-900 mb-3 flex items-center">
                                    <svg className="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                    Performance and Analytics Cookies
                                </h3>
                                <p className="text-gray-700 leading-relaxed mb-3">
                                    These cookies help us understand how visitors interact with our website by collecting and reporting 
                                    information anonymously. This helps us improve website performance and user experience.
                                </p>
                                <p className="text-sm text-gray-600 italic">
                                    Examples: Google Analytics, visitor counting, page view tracking
                                </p>
                            </div>

                            {/* Functionality Cookies */}
                            <div className="bg-gray-50 rounded-xl p-6 mb-6 border-l-4 border-purple-500">
                                <h3 className="text-xl font-bold text-gray-900 mb-3 flex items-center">
                                    <svg className="w-6 h-6 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Functionality Cookies
                                </h3>
                                <p className="text-gray-700 leading-relaxed mb-3">
                                    These cookies allow the website to remember choices you make and provide enhanced, personalized features.
                                </p>
                                <p className="text-sm text-gray-600 italic">
                                    Examples: Language preference, region selection, user interface customization
                                </p>
                            </div>

                            {/* Targeting Cookies */}
                            <div className="bg-gray-50 rounded-xl p-6 mb-6 border-l-4 border-orange-500">
                                <h3 className="text-xl font-bold text-gray-900 mb-3 flex items-center">
                                    <svg className="w-6 h-6 text-orange-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                                    </svg>
                                    Targeting and Advertising Cookies
                                </h3>
                                <p className="text-gray-700 leading-relaxed mb-3">
                                    These cookies are used to deliver advertisements relevant to you and your interests. They also help 
                                    measure the effectiveness of advertising campaigns.
                                </p>
                                <p className="text-sm text-gray-600 italic">
                                    Examples: Facebook Pixel, Google Ads, remarketing cookies
                                </p>
                            </div>
                        </div>

                        {/* How We Use Cookies */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">How We Use Cookies</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                We use cookies for the following purposes:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li><strong>Authentication:</strong> To identify you when you sign in and keep you logged in</li>
                                <li><strong>Security:</strong> To detect and prevent security risks and fraudulent activity</li>
                                <li><strong>Preferences:</strong> To remember your settings and preferences</li>
                                <li><strong>Analytics:</strong> To understand how you use our website and improve performance</li>
                                <li><strong>Advertising:</strong> To show you relevant ads and measure campaign effectiveness</li>
                                <li><strong>Features:</strong> To provide enhanced functionality and personalized content</li>
                            </ul>
                        </div>

                        {/* Third-Party Cookies */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Third-Party Cookies</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                In addition to our own cookies, we may use various third-party cookies to report usage statistics, 
                                deliver advertisements, and provide enhanced features. Third-party services we use include:
                            </p>
                            <div className="grid md:grid-cols-2 gap-4">
                                <div className="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 className="font-bold text-gray-900 mb-2">Google Analytics</h4>
                                    <p className="text-sm text-gray-600">Website analytics and reporting</p>
                                </div>
                                <div className="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 className="font-bold text-gray-900 mb-2">Facebook Pixel</h4>
                                    <p className="text-sm text-gray-600">Advertising and conversion tracking</p>
                                </div>
                                <div className="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 className="font-bold text-gray-900 mb-2">Google Ads</h4>
                                    <p className="text-sm text-gray-600">Advertising and remarketing</p>
                                </div>
                                <div className="bg-white rounded-lg p-4 border border-gray-200">
                                    <h4 className="font-bold text-gray-900 mb-2">YouTube</h4>
                                    <p className="text-sm text-gray-600">Embedded video content</p>
                                </div>
                            </div>
                        </div>

                        {/* Managing Cookies */}
                        <div className="mb-12 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Managing Your Cookie Preferences</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                You have the right to decide whether to accept or reject cookies. You can manage your cookie 
                                preferences in several ways:
                            </p>
                            
                            <h3 className="text-xl font-bold text-gray-900 mb-3 mt-6">Browser Settings</h3>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                Most web browsers allow you to control cookies through their settings. You can:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4 mb-6">
                                <li>Block all cookies</li>
                                <li>Accept only first-party cookies</li>
                                <li>Delete cookies when you close your browser</li>
                                <li>View and delete individual cookies</li>
                            </ul>

                            <h3 className="text-xl font-bold text-gray-900 mb-3">Browser-Specific Instructions</h3>
                            <div className="space-y-2 text-gray-700">
                                <p>• <strong>Chrome:</strong> Settings → Privacy and security → Cookies and other site data</p>
                                <p>• <strong>Firefox:</strong> Settings → Privacy & Security → Cookies and Site Data</p>
                                <p>• <strong>Safari:</strong> Preferences → Privacy → Manage Website Data</p>
                                <p>• <strong>Edge:</strong> Settings → Cookies and site permissions</p>
                            </div>

                            <div className="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                                <p className="text-sm text-gray-700">
                                    <strong>Please note:</strong> If you disable or delete cookies, some features of our website 
                                    may not function properly, and you may not be able to access certain areas or features.
                                </p>
                            </div>
                        </div>

                        {/* Do Not Track */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Do Not Track Signals</h2>
                            <p className="text-gray-700 leading-relaxed">
                                Some web browsers have a "Do Not Track" feature that signals to websites you visit that you do not 
                                want to have your online activity tracked. Our website currently does not respond to Do Not Track signals, 
                                but you can manage your cookie preferences as described above.
                            </p>
                        </div>

                        {/* Updates to Policy */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Updates to This Cookie Policy</h2>
                            <p className="text-gray-700 leading-relaxed">
                                We may update this Cookie Policy from time to time to reflect changes in technology, legislation, 
                                or our business practices. We will post any changes on this page with an updated revision date. 
                                We encourage you to review this Cookie Policy periodically.
                            </p>
                        </div>

                        {/* More Information */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">More Information About Cookies</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                For more information about cookies and how to manage them, you can visit:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li><a href="https://www.allaboutcookies.org" target="_blank" rel="noopener noreferrer" className="text-orange-600 hover:underline">www.allaboutcookies.org</a></li>
                                <li><a href="https://www.youronlinechoices.eu" target="_blank" rel="noopener noreferrer" className="text-orange-600 hover:underline">www.youronlinechoices.eu</a></li>
                                <li><a href="https://www.networkadvertising.org" target="_blank" rel="noopener noreferrer" className="text-orange-600 hover:underline">www.networkadvertising.org</a></li>
                            </ul>
                        </div>

                        {/* Contact Information */}
                        <div className="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8 border-l-4 border-orange-500">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Contact Us</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                If you have any questions about our use of cookies or this Cookie Policy, please contact us:
                            </p>
                            <div className="space-y-2 text-gray-700">
                                <p><strong>SUNNY AUTO</strong></p>
                                <p><strong>HQ - Hanoi:</strong> Room 801, Floor 8, West 1 Tower, Vinhomes West Point, HH Land Plot, Pham Hung Street, Tu Liem Ward, Hanoi City</p>
                                <p><strong>Office - HCMC:</strong> Level 17, Victory Tower, 12 Tan Trao Street, Tan My Ward, HCMC</p>
                                <p>Email: sales@sunnyauto.vn</p>
                                <p>Phone: +84 28 5411 9449</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </Layout>
    );
}

export default CookiePolicy;
