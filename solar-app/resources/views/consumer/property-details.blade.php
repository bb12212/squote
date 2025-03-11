<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property Details - SolarQuotes</title>
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
            width: 40%; /* Adjust based on progress - 40% for step 2 */
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
        
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236b7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            background-size: 16px 16px;
            padding-right: 40px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: flex-start;
            margin-bottom: 24px;
        }
        
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-right: 8px;
        }
        
        .checkbox {
            width: 18px;
            height: 18px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            margin-right: 8px;
            cursor: pointer;
            position: relative;
        }
        
        .checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        
        .checkbox-label {
            font-weight: 500;
            color: #374151;
        }
        
        .checkbox-description {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 4px;
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
                    <div class="step active">
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
                <h1>Step 2: Property Details</h1>
                <p class="subtitle">Please provide details about your property to help us find the best solar solutions for you.</p>
                
                <form action="{{ route('consumer.store-property-details') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label for="property_type">Property Type</label>
                        <select id="property_type" name="property_type" class="form-control" required>
                            <option value="">Select property type</option>
                            @foreach(\App\Models\Property::propertyTypes() as $value => $label)
                                <option value="{{ $value }}" {{ old('property_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('property_type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="roof_type">Roof Type</label>
                        <select id="roof_type" name="roof_type" class="form-control">
                            <option value="">Select roof type</option>
                            @foreach(\App\Models\Property::roofTypes() as $value => $label)
                                <option value="{{ $value }}" {{ old('roof_type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('roof_type')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="roof_material">Roof Material</label>
                        <select id="roof_material" name="roof_material" class="form-control">
                            <option value="">Select roof material</option>
                            @foreach(\App\Models\Property::roofMaterials() as $value => $label)
                                <option value="{{ $value }}" {{ old('roof_material') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('roof_material')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="checkbox-group">
                        <div class="checkbox-container">
                            <label class="checkbox">
                                <input type="checkbox" id="has_significant_shading" name="has_significant_shading" value="1" {{ old('has_significant_shading') ? 'checked' : '' }}>
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div>
                            <div class="checkbox-label">Significant Shading</div>
                            <div class="checkbox-description">Does your roof experience significant shading during the day?</div>
                            @error('has_significant_shading')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="monthly_energy_bill">Monthly Energy Bill ($)</label>
                        <input type="number" id="monthly_energy_bill" name="monthly_energy_bill" value="{{ old('monthly_energy_bill') }}" min="0" step="0.01" class="form-control">
                        @error('monthly_energy_bill')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="annual_energy_usage">Annual Energy Usage (kWh)</label>
                        <input type="number" id="annual_energy_usage" name="annual_energy_usage" value="{{ old('annual_energy_usage') }}" min="0" class="form-control">
                        @error('annual_energy_usage')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="button-group">
                        <a href="{{ route('consumer.service-selection') }}" class="button button-secondary">
                            <svg viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to Services
                        </a>
                        <button type="submit" class="button button-primary">
                            Next: Contact Information
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
        // Add custom checkbox styling
        document.addEventListener('DOMContentLoaded', function() {
            const checkbox = document.getElementById('has_significant_shading');
            const checkboxLabel = checkbox.closest('.checkbox');
            
            // Initialize checkbox state
            updateCheckboxStyle();
            
            // Add event listener to update checkbox style when clicked
            checkbox.addEventListener('change', updateCheckboxStyle);
            
            function updateCheckboxStyle() {
                if (checkbox.checked) {
                    checkboxLabel.style.backgroundColor = '#16a34a';
                    checkboxLabel.style.borderColor = '#16a34a';
                    checkboxLabel.innerHTML = `
                        <input type="checkbox" id="has_significant_shading" name="has_significant_shading" value="1" checked>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                            <path d="M5 13l4 4L19 7" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    `;
                } else {
                    checkboxLabel.style.backgroundColor = 'white';
                    checkboxLabel.style.borderColor = '#d1d5db';
                    checkboxLabel.innerHTML = `
                        <input type="checkbox" id="has_significant_shading" name="has_significant_shading" value="1">
                    `;
                }
            }
        });
    </script>
</body>
</html> 