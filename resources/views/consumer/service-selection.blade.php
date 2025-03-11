<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Services - SolarQuotes</title>
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
            width: 20%; /* Adjust based on progress */
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
        
        /* Service Cards */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .service-card {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 20px;
            position: relative;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .service-card:hover {
            border-color: #d1fae5;
            box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        }
        
        .service-card.selected {
            border-color: #16a34a;
            background-color: #f0fdf4;
        }
        
        .service-header {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }
        
        .service-icon {
            width: 50px;
            height: 50px;
            background-color: #d1fae5;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }
        
        .service-icon svg {
            width: 24px;
            height: 24px;
            color: #16a34a;
        }
        
        .service-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 5px;
        }
        
        .service-description {
            font-size: 0.875rem;
            color: #6b7280;
        }
        
        .checkbox {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 20px;
            height: 20px;
            border: 2px solid #d1d5db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .service-card.selected .checkbox {
            border-color: #16a34a;
            background-color: #16a34a;
        }
        
        .checkbox svg {
            width: 12px;
            height: 12px;
            color: white;
            display: none;
        }
        
        .service-card.selected .checkbox svg {
            display: block;
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
        
        /* Error Message */
        .error-message {
            background-color: #fee2e2;
            border-left: 4px solid #ef4444;
            padding: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
        }
        
        .error-icon {
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        .error-text {
            color: #b91c1c;
            font-size: 0.875rem;
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
                    <div class="step active">
                        1
                        <span class="step-label">Services</span>
                    </div>
                    <div class="step">
                        2
                        <span class="step-label">Property</span>
                    </div>
                    <div class="step">
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
                <h1>Step 1: Select Services</h1>
                <p class="subtitle">Which solar services are you interested in? Select all that apply.</p>
                
                @if($errors->has('services'))
                <div class="error-message">
                    <div class="error-icon">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 18C14.4183 18 18 14.4183 18 10C18 5.58172 14.4183 2 10 2C5.58172 2 2 5.58172 2 10C2 14.4183 5.58172 18 10 18ZM8.70711 7.29289C8.31658 6.90237 7.68342 6.90237 7.29289 7.29289C6.90237 7.68342 6.90237 8.31658 7.29289 8.70711L8.58579 10L7.29289 11.2929C6.90237 11.6834 6.90237 12.3166 7.29289 12.7071C7.68342 13.0976 8.31658 13.0976 8.70711 12.7071L10 11.4142L11.2929 12.7071C11.6834 13.0976 12.3166 13.0976 12.7071 12.7071C13.0976 12.3166 13.0976 11.6834 12.7071 11.2929L11.4142 10L12.7071 8.70711C13.0976 8.31658 13.0976 7.68342 12.7071 7.29289C12.3166 6.90237 11.6834 6.90237 11.2929 7.29289L10 8.58579L8.70711 7.29289Z" fill="#B91C1C"/>
                        </svg>
                    </div>
                    <div class="error-text">{{ $errors->first('services') }}</div>
                </div>
                @endif
                
                <form action="{{ route('consumer.store-services') }}" method="POST">
                    @csrf
                    
                    <div class="services-grid">
                        @php
                            // Get unique services by ID to avoid duplicates
                            $uniqueServices = $services->unique('id');
                        @endphp
                        
                        @foreach($uniqueServices as $service)
                        <div class="service-card {{ in_array($service->id, old('services', [])) ? 'selected' : '' }}" onclick="toggleService(this, {{ $service->id }})">
                            <input type="checkbox" 
                                   name="services[]" 
                                   value="{{ $service->id }}" 
                                   class="service-input"
                                   id="service-{{ $service->id }}"
                                   {{ in_array($service->id, old('services', [])) ? 'checked' : '' }}
                                   style="position: absolute; opacity: 0;">
                            
                            <div class="service-header">
                                <div class="service-icon">
                                    @if($service->icon == 'solar-panel')
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @elseif($service->icon == 'battery')
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17 6h-2V3a1 1 0 00-1-1h-4a1 1 0 00-1 1v3H7a2 2 0 00-2 2v11a2 2 0 002 2h10a2 2 0 002-2V8a2 2 0 00-2-2zm-2 0H9V3h6v3z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @elseif($service->icon == 'ev-charger')
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @elseif($service->icon == 'hot-water')
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @else
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="service-title">{{ $service->name }}</h3>
                                    <p class="service-description">{{ $service->description }}</p>
                                </div>
                            </div>
                            
                            <div class="checkbox">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="button-group">
                        <a href="{{ route('consumer.index') }}" class="button button-secondary">
                            <svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Home
                        </a>
                        <button type="submit" class="button button-primary">
                            Next: Property Details
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
        // Improved JavaScript to toggle service selection
        function toggleService(card, serviceId) {
            // Find the checkbox
            const checkbox = document.getElementById('service-' + serviceId);
            
            // Toggle the checkbox state
            checkbox.checked = !checkbox.checked;
            
            // Toggle the selected class on the card
            if (checkbox.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
        }
        
        // Initialize any cards that should be selected on page load
        document.addEventListener('DOMContentLoaded', function() {
            const serviceCards = document.querySelectorAll('.service-card');
            
            serviceCards.forEach(card => {
                const checkbox = card.querySelector('input[type="checkbox"]');
                if (checkbox.checked) {
                    card.classList.add('selected');
                }
                
                // Prevent the click on the checkbox from triggering the card click event twice
                checkbox.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // Update the card class based on the checkbox state
                    if (this.checked) {
                        card.classList.add('selected');
                    } else {
                        card.classList.remove('selected');
                    }
                });
            });
        });
    </script>
</body>
</html> 