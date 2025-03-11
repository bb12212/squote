<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - SolarQuotes</title>
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
        
        /* Main Content */
        main {
            margin-top: 80px;
            padding: 40px 0;
        }
        
        /* Progress Bar */
        .progress-container {
            margin-bottom: 30px;
        }
        
        .progress-bar {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 30px;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .progress-bar::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 4px;
            width: 100%;
            background-color: #e5e7eb;
            z-index: 1;
        }
        
        .progress-bar-fill {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            height: 4px;
            width: 100%; /* Adjust based on progress - 100% for step 5 */
            background-color: #16a34a;
            z-index: 2;
        }
        
        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #6b7280;
            position: relative;
            z-index: 3;
        }
        
        .step.active {
            border-color: #16a34a;
            background-color: #16a34a;
            color: white;
        }
        
        .step.completed {
            border-color: #16a34a;
            background-color: #16a34a;
            color: white;
        }
        
        .step-label {
            position: absolute;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            white-space: nowrap;
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .step.active .step-label {
            color: #16a34a;
            font-weight: 500;
        }
        
        .step.completed .step-label {
            color: #16a34a;
        }
        
        /* Confirmation Section */
        .confirmation-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
            text-align: center;
        }
        
        .success-icon {
            color: #16a34a;
            margin-bottom: 24px;
        }
        
        h1 {
            font-size: 2.25rem;
            color: #111827;
            margin-bottom: 16px;
        }
        
        .subtitle {
            color: #6b7280;
            font-size: 1.125rem;
            margin-bottom: 32px;
        }
        
        /* Next Steps Card */
        .next-steps-card {
            background-color: #f9fafb;
            border-radius: 8px;
            padding: 24px;
            margin: 0 auto 32px;
            max-width: 600px;
            text-align: left;
        }
        
        .next-steps-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
        }
        
        .steps-list {
            list-style: none;
        }
        
        .step-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 16px;
        }
        
        .step-icon {
            flex-shrink: 0;
            color: #16a34a;
            margin-right: 12px;
        }
        
        .step-content {
            flex: 1;
        }
        
        .step-title {
            font-weight: 600;
            color: #374151;
            display: inline;
        }
        
        .step-description {
            color: #4b5563;
        }
        
        /* Account Section */
        .account-section {
            margin-bottom: 32px;
        }
        
        .account-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 16px;
        }
        
        .account-description {
            color: #6b7280;
            margin-bottom: 16px;
        }
        
        /* Buttons */
        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        
        .button-primary {
            background-color: #16a34a;
            color: white;
            border: 1px solid #16a34a;
        }
        
        .button-primary:hover {
            background-color: #15803d;
        }
        
        .home-link {
            display: inline-block;
            color: #16a34a;
            text-decoration: none;
            font-weight: 500;
            margin-top: 16px;
        }
        
        .home-link:hover {
            text-decoration: underline;
        }
        
        /* Footer */
        footer {
            background-color: #111827;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
        }
        
        .footer-logo {
            display: flex;
            align-items: center;
            color: white;
            font-weight: bold;
            font-size: 1.25rem;
            margin-bottom: 15px;
            text-decoration: none;
        }
        
        .footer-logo svg {
            margin-right: 10px;
        }
        
        .footer-description {
            color: #9ca3af;
            margin-bottom: 20px;
            font-size: 0.875rem;
        }
        
        .footer-heading {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: white;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .footer-bottom {
            border-top: 1px solid #374151;
            margin-top: 40px;
            padding-top: 20px;
            color: #9ca3af;
            font-size: 0.875rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .step-label {
                display: none;
            }
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
                    <a href="#how-it-works">How it Works</a>
                    <a href="#benefits">Benefits</a>
                    <a href="#contact">Contact</a>
                </div>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <!-- Progress Bar -->
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress-bar-fill"></div>
                    <div class="step completed">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 13l4 4L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="step-label">Services</span>
                    </div>
                    <div class="step completed">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 13l4 4L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="step-label">Property</span>
                    </div>
                    <div class="step completed">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 13l4 4L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="step-label">Contact</span>
                    </div>
                    <div class="step completed">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 13l4 4L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="step-label">Details</span>
                    </div>
                    <div class="step active">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 13l4 4L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="step-label">Confirmation</span>
                    </div>
                </div>
            </div>
            
            <!-- Confirmation Section -->
            <div class="confirmation-section">
                <div class="success-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                
                <h1>Thank You!</h1>
                <p class="subtitle">Your request for solar quotes has been submitted successfully.</p>
                
                <div class="next-steps-card">
                    <h2 class="next-steps-title">What happens next?</h2>
                    <ul class="steps-list">
                        <li class="step-item">
                            <div class="step-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="step-content">
                                <span class="step-title">Review:</span>
                                <span class="step-description"> Our team will review your request and match you with up to 3 trusted solar installers in your area.</span>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="step-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="step-content">
                                <span class="step-title">Contact:</span>
                                <span class="step-description"> Installers will contact you within 48 hours via your preferred contact method.</span>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="step-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="step-content">
                                <span class="step-title">Quotes:</span>
                                <span class="step-description"> You'll receive detailed quotes tailored to your specific requirements.</span>
                            </div>
                        </li>
                        <li class="step-item">
                            <div class="step-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <div class="step-content">
                                <span class="step-title">Decision:</span>
                                <span class="step-description"> Compare quotes and choose the installer that best meets your needs.</span>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="account-section">
                    <h2 class="account-title">Create an Account (Optional)</h2>
                    <p class="account-description">Create an account to track your quotes and communicate with installers through our platform.</p>
                    <a href="#" class="button button-primary">Create Account</a>
                </div>
                
                <a href="{{ route('consumer.index') }}" class="home-link">Return to Home</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div>
                    <a href="/" class="footer-logo">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 3V21M12 3L8 7M12 3L16 7M12 21L8 17M12 21L16 17M21 12H3M21 12L17 8M21 12L17 16M3 12L7 8M3 12L7 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        SolarQuotes
                    </a>
                    <p class="footer-description">Helping Kiwis make the switch to solar power since 2023.</p>
                </div>
                
                <div>
                    <h4 class="footer-heading">Company</h4>
                    <ul class="footer-links">
                        <li><a href="#">About</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Resources</h4>
                    <ul class="footer-links">
                        <li><a href="#">Solar Guide</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-heading">Legal</h4>
                    <ul class="footer-links">
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">Terms</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} SolarQuotes. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> 