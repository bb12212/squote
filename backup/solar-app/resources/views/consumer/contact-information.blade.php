<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Information - SolarQuotes</title>
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
            width: 60%; /* Adjust based on progress - 60% for step 3 */
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
        
        /* Form Section */
        .form-section {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 30px;
            margin-top: 30px;
        }
        
        h1 {
            font-size: 1.875rem;
            color: #111827;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: #6b7280;
            margin-bottom: 30px;
        }
        
        /* Form Elements */
        .form-group {
            margin-bottom: 24px;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-bottom: 24px;
        }
        
        @media (min-width: 768px) {
            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }
        
        label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
            color: #374151;
        }
        
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        
        .form-control:focus {
            border-color: #16a34a;
            box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2);
            outline: none;
        }
        
        /* Radio Buttons */
        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 8px;
        }
        
        .radio-container {
            display: flex;
            align-items: center;
        }
        
        .radio-label {
            margin-left: 8px;
            font-weight: normal;
        }
        
        .radio-custom {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 2px solid #d1d5db;
            background-color: white;
            cursor: pointer;
        }
        
        .radio-custom input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        
        .radio-custom input:checked ~ .radio-checkmark {
            display: block;
        }
        
        .radio-checkmark {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #16a34a;
        }
        
        .error-message {
            color: #b91c1c;
            font-size: 0.875rem;
            margin-top: 4px;
        }
        
        /* Buttons */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        
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
        
        .button-secondary {
            background-color: white;
            color: #4b5563;
            border: 1px solid #d1d5db;
        }
        
        .button-secondary:hover {
            background-color: #f9fafb;
        }
        
        .button-primary {
            background-color: #16a34a;
            color: white;
            border: 1px solid #16a34a;
        }
        
        .button-primary:hover {
            background-color: #15803d;
        }
        
        .button svg {
            width: 20px;
            height: 20px;
        }
        
        .button-secondary svg {
            margin-right: 8px;
        }
        
        .button-primary svg {
            margin-left: 8px;
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
            .button-group {
                flex-direction: column;
                gap: 10px;
            }
            
            .button {
                width: 100%;
            }
            
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
                    <div class="step active">
                        3
                        <span class="step-label">Contact</span>
                    </div>
                    <div class="step">
                        4
                        <span class="step-label">Details</span>
                    </div>
                    <div class="step">
                        5
                        <span class="step-label">Confirmation</span>
                    </div>
                </div>
            </div>
            
            <!-- Form Section -->
            <div class="form-section">
                <h1>Step 3: Contact Information</h1>
                <p class="subtitle">Please provide your contact details so installers can reach you with quotes.</p>
                
                <form action="{{ route('consumer.store-contact-information') }}" method="POST">
                    @csrf
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" class="form-control" required>
                            @error('first_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" class="form-control" required>
                            @error('last_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" class="form-control">
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Preferred Contact Method</label>
                        <div class="radio-group">
                            <div class="radio-container">
                                <label class="radio-custom">
                                    <input type="radio" name="preferred_contact_method" value="email" {{ old('preferred_contact_method') == 'email' ? 'checked' : '' }} required>
                                    <span class="radio-checkmark"></span>
                                </label>
                                <span class="radio-label">Email</span>
                            </div>
                            <div class="radio-container">
                                <label class="radio-custom">
                                    <input type="radio" name="preferred_contact_method" value="phone" {{ old('preferred_contact_method') == 'phone' ? 'checked' : '' }}>
                                    <span class="radio-checkmark"></span>
                                </label>
                                <span class="radio-label">Phone</span>
                            </div>
                            <div class="radio-container">
                                <label class="radio-custom">
                                    <input type="radio" name="preferred_contact_method" value="either" {{ old('preferred_contact_method') == 'either' ? 'checked' : '' }}>
                                    <span class="radio-checkmark"></span>
                                </label>
                                <span class="radio-label">Either</span>
                            </div>
                        </div>
                        @error('preferred_contact_method')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="button-group">
                        <a href="{{ route('consumer.property-details') }}" class="button button-secondary">
                            <svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Property Details
                        </a>
                        <button type="submit" class="button button-primary">
                            Next: Additional Details
                            <svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
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

    <script>
        // Add custom radio button styling
        document.addEventListener('DOMContentLoaded', function() {
            const radioInputs = document.querySelectorAll('input[type="radio"][name="preferred_contact_method"]');
            
            // Initialize radio button states
            radioInputs.forEach(function(radio) {
                updateRadioStyle(radio);
            });
            
            // Add event listeners to update radio button styles when clicked
            radioInputs.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    radioInputs.forEach(function(r) {
                        updateRadioStyle(r);
                    });
                });
            });
            
            function updateRadioStyle(radio) {
                const customRadio = radio.closest('.radio-custom');
                if (radio.checked) {
                    customRadio.style.borderColor = '#16a34a';
                } else {
                    customRadio.style.borderColor = '#d1d5db';
                }
            }
        });
    </script>
</body>
</html> 