<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Your Solar Quote - SolarQuotes</title>
    <style>
        /* Simple Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
        }
        
        /* Simple Layout */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }
        
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 1.5rem;
            color: #16a34a;
            text-decoration: none;
        }
        
        .logo svg {
            margin-right: 10px;
        }
        
        .nav-links a {
            margin-left: 20px;
            color: #555;
            text-decoration: none;
        }
        
        .nav-links a:hover {
            color: #16a34a;
        }
        
        .provider-link {
            background-color: #16a34a;
            color: white !important;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        
        .provider-link:hover {
            background-color: #15803d;
            color: white !important;
        }
        
        /* Main Content */
        main {
            margin-top: 80px;
            padding: 40px 0;
        }
        
        /* Hero Section */
        .hero {
            padding: 60px 0;
            background-color: #f0fdf4;
            border-radius: 10px;
            margin-bottom: 60px;
        }
        
        .hero-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #111;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 600px;
            margin-bottom: 30px;
            color: #555;
        }
        
        /* Form */
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        input[type="text"]:focus {
            border-color: #16a34a;
            outline: none;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2);
        }
        
        button {
            background-color: #16a34a;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            font-weight: 500;
        }
        
        button:hover {
            background-color: #15803d;
        }
        
        /* Features */
        .features {
            padding: 60px 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }
        
        h2 {
            font-size: 2rem;
            color: #111;
            margin-bottom: 15px;
        }
        
        .section-title p {
            color: #555;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .feature-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            background-color: #f0fdf4;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        .feature-icon svg {
            width: 30px;
            height: 30px;
            color: #16a34a;
        }
        
        h3 {
            font-size: 1.3rem;
            margin-bottom: 15px;
            color: #111;
        }
        
        /* How It Works */
        .how-it-works {
            padding: 60px 0;
            background-color: #f9f9f9;
        }
        
        .steps {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }
        
        .step {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: relative;
        }
        
        .step-number {
            background-color: #16a34a;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        
        /* CTA */
        .cta {
            padding: 60px 0;
            text-align: center;
        }
        
        .cta-container {
            background: linear-gradient(to right, #16a34a, #15803d);
            padding: 60px;
            border-radius: 10px;
            color: white;
        }
        
        .cta h2 {
            color: white;
            margin-bottom: 20px;
        }
        
        .cta p {
            color: rgba(255,255,255,0.9);
            margin-bottom: 30px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .cta-button {
            background-color: white;
            color: #16a34a;
            display: inline-block;
            padding: 15px 30px;
            border-radius: 5px;
            font-weight: 500;
            text-decoration: none;
        }
        
        .cta-button:hover {
            background-color: rgba(255,255,255,0.9);
        }
        
        /* Footer */
        footer {
            background-color: #111;
            color: white;
            padding: 60px 0 30px;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }
        
        .footer-logo {
            color: white;
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            text-decoration: none;
        }
        
        .footer-logo svg {
            margin-right: 10px;
        }
        
        .footer-links h4 {
            color: white;
            margin-bottom: 20px;
            font-size: 1.1rem;
        }
        
        .footer-links ul {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .copyright {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 30px;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            .hero {
                padding: 40px 0;
            }
            
            .form-container {
                padding: 20px;
            }
            
            .cta-container {
                padding: 40px 20px;
            }
        }

        /* Provider CTA Section */
        .provider-cta {
            padding: 80px 0;
            background-color: #f0fdf4;
            margin-top: 60px;
        }
        
        .provider-cta-content {
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
        }
        
        .provider-cta h2 {
            font-size: 2.2rem;
            margin-bottom: 15px;
            color: #111;
        }
        
        .provider-cta p {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 40px;
        }
        
        .provider-benefits {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .benefit {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .benefit-icon {
            background-color: #f0fdf4;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
        }
        
        .benefit-icon svg {
            width: 25px;
            height: 25px;
            color: #16a34a;
        }
        
        .provider-cta-button {
            display: inline-block;
            background-color: #16a34a;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            font-size: 1.1rem;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .provider-cta-button:hover {
            background-color: #15803d;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="/" class="logo">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 3V21M12 3L8 7M12 3L16 7M12 21L8 17M12 21L16 17M21 12H3M21 12L17 8M21 12L17 16M3 12L7 8M3 12L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    SolarQuotes
                </a>
                <div class="nav-links">
                    <a href="#features">Features</a>
                    <a href="#how-it-works">How It Works</a>
                    <a href="#testimonials">Testimonials</a>
                    <a href="{{ route('provider.register') }}" class="provider-link">For Installers</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Save Money with Solar Power</h1>
                    <p>Get free quotes from trusted local solar installers and start saving on your energy bills today.</p>
                    
                    <div class="form-container">
                        <form action="{{ route('consumer.validate-postcode') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="postcode">Enter your postcode</label>
                                <input type="text" name="postcode" id="postcode" placeholder="e.g., 1010" required>
                                @error('postcode')
                                    <p style="color: red; margin-top: 5px; font-size: 0.9rem;">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit">Get Free Quotes</button>
                            
                            <div style="margin-top: 20px; display: flex; justify-content: center; gap: 20px; color: #666; font-size: 0.9rem;">
                                <div>✓ Free Quote</div>
                                <div>✓ No Obligation</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features" id="benefits">
            <div class="container">
                <div class="section-title">
                    <h2>Why Choose Solar Energy?</h2>
                    <p>Solar power is a smart investment that pays for itself while helping the environment.</p>
                </div>

                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Save Money</h3>
                        <p>Reduce your electricity bills by up to 50% and protect against rising energy costs.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Help the Planet</h3>
                        <p>Reduce your carbon footprint and contribute to a sustainable future.</p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h3>Increase Home Value</h3>
                        <p>Add value to your property with a modern, sustainable energy solution.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works" id="how-it-works">
            <div class="container">
                <div class="section-title">
                    <h2>How It Works</h2>
                    <p>Get your solar quote in three easy steps</p>
                </div>

                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Enter Your Postcode</h3>
                        <p>We'll check if solar is suitable for your area and find local installers.</p>
                    </div>

                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Compare Quotes</h3>
                        <p>Receive up to 3 competitive quotes from trusted local installers.</p>
                    </div>

                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Choose & Save</h3>
                        <p>Select the best offer and start saving on your energy bills.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta">
            <div class="container">
                <div class="cta-container">
                    <h2>Ready to Start Saving?</h2>
                    <p>Get your free solar quotes today and join thousands of Kiwis who are already saving with solar power.</p>
                    <a href="#" class="cta-button">Get Your Free Quote</a>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <!-- ... existing testimonials code ... -->

        <!-- Provider CTA Section -->
        <section class="provider-cta">
            <div class="container">
                <div class="provider-cta-content">
                    <h2>Are You a Solar Installer?</h2>
                    <p>Join our network of trusted solar providers and connect with customers looking for quality installations.</p>
                    <div class="provider-benefits">
                        <div class="benefit">
                            <div class="benefit-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                            </div>
                            <h3>High-Quality Leads</h3>
                            <p>Connect with customers who are actively seeking solar installations.</p>
                        </div>
                        <div class="benefit">
                            <div class="benefit-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3>Expand Your Customer Base</h3>
                            <p>Reach more potential customers in your service areas.</p>
                        </div>
                        <div class="benefit">
                            <div class="benefit-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3>Build Trust</h3>
                            <p>Join our network of vetted, reputable solar installers.</p>
                        </div>
                    </div>
                    <a href="{{ route('provider.register') }}" class="provider-cta-button">Register as a Provider</a>
                </div>
            </div>
        </section>
    </main>

    <footer id="contact">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a href="/" class="footer-logo">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3V21M12 3L8 7M12 3L16 7M12 21L8 17M12 21L16 17M21 12H3M21 12L17 8M21 12L17 16M3 12L7 8M3 12L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        SolarQuotes
                    </a>
                    <p>Helping Kiwis make the switch to solar power since 2023.</p>
                </div>
                
                <div class="footer-links">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">Solar Guide</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; {{ date('Y') }} SolarQuotes. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> 