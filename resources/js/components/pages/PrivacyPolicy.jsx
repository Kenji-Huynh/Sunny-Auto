import React from 'react';
import Layout from '../layout/Layout';

function PrivacyPolicy() {
    return (
        <Layout>
            {/* Hero Section */}
            <section className="bg-gradient-to-r from-[#1a2332] to-gray-800 py-20">
                <div className="container mx-auto px-4">
                    <div className="max-w-4xl mx-auto text-center">
                        <h1 className="text-4xl md:text-5xl font-bold text-white mb-6">
                            Privacy Policy
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
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Introduction</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                SUNNY AUTO ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy 
                                explains how we collect, use, disclose, and safeguard your information when you visit our website 
                                or use our services.
                            </p>
                            <p className="text-gray-700 leading-relaxed">
                                Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, 
                                please do not access the site or use our services.
                            </p>
                        </div>

                        {/* Information We Collect */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Information We Collect</h2>
                            
                            <h3 className="text-xl font-bold text-gray-900 mb-3 mt-6">Personal Information</h3>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                We may collect personal information that you voluntarily provide to us when you:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4 mb-4">
                                <li>Register on the website</li>
                                <li>Place an order or make a purchase</li>
                                <li>Subscribe to our newsletter</li>
                                <li>Fill out a contact form</li>
                                <li>Participate in surveys or promotions</li>
                            </ul>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                This information may include:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li>Name and contact information (email, phone number, address)</li>
                                <li>Payment information</li>
                                <li>Company name and business information</li>
                                <li>Vehicle preferences and requirements</li>
                            </ul>

                            <h3 className="text-xl font-bold text-gray-900 mb-3 mt-6">Automatically Collected Information</h3>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                When you visit our website, we automatically collect certain information about your device, including:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li>IP address and browser type</li>
                                <li>Operating system and device information</li>
                                <li>Pages visited and time spent on pages</li>
                                <li>Referring website addresses</li>
                                <li>Cookies and similar tracking technologies</li>
                            </ul>
                        </div>

                        {/* How We Use Your Information */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">How We Use Your Information</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                We use the information we collect for various purposes, including:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li>Processing and fulfilling your orders</li>
                                <li>Providing customer service and support</li>
                                <li>Sending administrative information and updates</li>
                                <li>Personalizing your experience on our website</li>
                                <li>Improving our products and services</li>
                                <li>Conducting analytics and research</li>
                                <li>Marketing and promotional communications (with your consent)</li>
                                <li>Detecting and preventing fraud and security threats</li>
                                <li>Complying with legal obligations</li>
                            </ul>
                        </div>

                        {/* Sharing Your Information */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Sharing Your Information</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                We may share your information with:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li>
                                    <strong>Service Providers:</strong> Third-party companies that help us operate our business 
                                    (payment processors, shipping companies, marketing partners)
                                </li>
                                <li>
                                    <strong>Business Partners:</strong> Companies within the Leong Lee Group for business purposes
                                </li>
                                <li>
                                    <strong>Legal Requirements:</strong> When required by law or to protect our rights and safety
                                </li>
                                <li>
                                    <strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets
                                </li>
                            </ul>
                            <p className="text-gray-700 leading-relaxed mt-4">
                                We do not sell your personal information to third parties.
                            </p>
                        </div>

                        {/* Data Security */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Data Security</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                We implement appropriate technical and organizational security measures to protect your personal 
                                information against unauthorized access, alteration, disclosure, or destruction. These measures include:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li>Encryption of sensitive data during transmission (SSL/TLS)</li>
                                <li>Regular security audits and assessments</li>
                                <li>Access controls and authentication procedures</li>
                                <li>Employee training on data protection</li>
                            </ul>
                            <p className="text-gray-700 leading-relaxed mt-4">
                                However, no method of transmission over the Internet is 100% secure. While we strive to protect 
                                your information, we cannot guarantee absolute security.
                            </p>
                        </div>

                        {/* Your Rights */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Your Rights</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                Depending on your location, you may have the following rights:
                            </p>
                            <ul className="list-disc list-inside space-y-2 text-gray-700 ml-4">
                                <li><strong>Access:</strong> Request access to your personal information</li>
                                <li><strong>Correction:</strong> Request correction of inaccurate or incomplete data</li>
                                <li><strong>Deletion:</strong> Request deletion of your personal information</li>
                                <li><strong>Objection:</strong> Object to processing of your personal information</li>
                                <li><strong>Data Portability:</strong> Request transfer of your data to another service</li>
                                <li><strong>Withdraw Consent:</strong> Withdraw consent for marketing communications</li>
                            </ul>
                            <p className="text-gray-700 leading-relaxed mt-4">
                                To exercise these rights, please contact us using the information provided below.
                            </p>
                        </div>

                        {/* Data Retention */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Data Retention</h2>
                            <p className="text-gray-700 leading-relaxed">
                                We retain your personal information for as long as necessary to fulfill the purposes outlined in 
                                this Privacy Policy, unless a longer retention period is required or permitted by law. When we no 
                                longer need your information, we will securely delete or anonymize it.
                            </p>
                        </div>

                        {/* International Data Transfers */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">International Data Transfers</h2>
                            <p className="text-gray-700 leading-relaxed">
                                Your information may be transferred to and processed in countries other than your country of 
                                residence, including Vietnam, China, and other countries in Southeast Asia. These countries may have 
                                different data protection laws. We ensure appropriate safeguards are in place to protect your information.
                            </p>
                        </div>

                        {/* Children's Privacy */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Children's Privacy</h2>
                            <p className="text-gray-700 leading-relaxed">
                                Our services are not directed to individuals under the age of 18. We do not knowingly collect 
                                personal information from children. If you become aware that a child has provided us with personal 
                                information, please contact us immediately.
                            </p>
                        </div>

                        {/* Changes to This Policy */}
                        <div className="mb-12">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Changes to This Privacy Policy</h2>
                            <p className="text-gray-700 leading-relaxed">
                                We may update this Privacy Policy from time to time. We will notify you of any changes by posting 
                                the new Privacy Policy on this page and updating the "Last updated" date. We encourage you to review 
                                this Privacy Policy periodically for any changes.
                            </p>
                        </div>

                        {/* Contact Information */}
                        <div className="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-8 border-l-4 border-orange-500">
                            <h2 className="text-3xl font-bold text-gray-900 mb-4">Contact Us</h2>
                            <p className="text-gray-700 leading-relaxed mb-4">
                                If you have any questions or concerns about this Privacy Policy or our data practices, please contact us:
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

export default PrivacyPolicy;
