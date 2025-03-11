**Product Requirements Document (PRD) - Solar Lead Generation App**

---

## **1. Overview**

The Solar Lead Generation App is designed to connect consumers interested in solar panel installations with reputable solar providers. Users can input their details to receive quotes from multiple providers, facilitating informed decision-making. The app supports communication through both email and an optional in-app messaging system. Provider matching is managed manually by the admin, assigning up to three preferred installers per region.

---

## **2. Goals & Objectives**

- **User-Friendly Experience:** Enable consumers to easily request and compare solar installation quotes without mandatory account creation.
- **High-Quality Leads:** Ensure solar providers receive detailed and relevant leads to increase conversion rates.
- **Flexible Communication:** Offer both email and in-app messaging options to accommodate user preferences.
- **Manual Provider Matching:** Allow admins to assign preferred installers to users based on their region.
- **Monetization:** Generate revenue through lead generation fees and premium services for installers.

---

## **3. Tech Stack**

- **Frontend & Backend:** Laravel TALL Stack (Tailwind CSS, Alpine.js, Laravel, Livewire). adhear to tailwind docs https://catalyst.tailwindui.com/docs
- **Database:** Supabase
- **Authentication:** Supabase Auth with optional magic link functionality
- **Hosting:** Laravel Forge or Vapor
- **Messaging:** Laravel Echo for real-time in-app messaging

---

## **4. Key Features**

### **4.1 Consumer Journey**

1. **Landing Page**
   - **Prominent Postcode Entry Field:** A centrally located input box labeled "Enter your postcode to start your free solar quotes."
   - **Call-to-Action (CTA) Button:** A clear, inviting button labeled "Get Started" adjacent to the postcode field.
   - **Brief Value Proposition:** A concise statement highlighting the benefits of obtaining multiple solar quotes, such as cost savings and access to reputable installers.

2. **Step 1: Service Selection**
   - **Multiple Choice Options:** Checkboxes or icons allowing users to select from services like:
     - Solar Panel Installation
     - Battery Storage
     - EV Charger Installation
     - Solar Hot Water Systems
   - **Progress Indicator:** A visual bar or steps indicator showing the user's progress through the form.

3. **Step 2: Property and Energy Details**
   - **Property Type:** Dropdown menu with options like:
     - Detached House
     - Semi-Detached House
     - Terraced House
     - Apartment
   - **Roof Characteristics:** Options to specify roof type (e.g., pitched, flat) and material (e.g., tile, metal).
   - **Shading Information:** Checkbox to indicate if the roof experiences significant shading.
   - **Energy Consumption:** Field to input average monthly electricity bill or annual energy usage.

4. **Step 3: Contact Information**
   - **Name:** Fields for first and last name.
   - **Email Address:** Input field with validation for correct email format.
   - **Phone Number:** Input field with country code selection.
   - **Preferred Contact Method:** Options to choose between email, phone, or either.

5. **Step 4: Additional Details (Optional)**
   - **Text Box:** Open-ended field for users to add comments or specific requirements.

6. **Submission Confirmation**
   - **Thank You Message:** A confirmation note informing users that their details have been received and that they will be contacted by up to three installers.
   - **Estimated Response Time:** Information on when they can expect to hear from the installers.
   - **Optional Account Creation Prompt:** Encourage users to create an account to track their quotes and communications, emphasizing that it's optional.

7. **Email Confirmation**
   - **Submission Summary:** Details of the information provided by the user.
   - **Next Steps:** Outline what the user should expect, such as being contacted by installers.
   - **Account Creation Link:** Offer a link to set up an account for enhanced tracking and communication features.

### **4.2 Provider Journey**

1. **Provider Registration & Authentication**
   - **Account Creation:** Installers create accounts to access the installer portal.
   - **Profile Setup:** Providers complete their profiles, detailing services offered, coverage areas, certifications, and contact information.

2. **Lead Management**
   - **Portal Access:** Providers access a dedicated portal to view and manage matched leads.
   - **Communication:** Engage with potential customers through the portal's in-app messaging system or via email, based on user preference.

3. **Quote Submission**
   - **Standardized Templates:** Submit quotes using standardized templates to ensure consistency and ease of comparison for users.

4. **Subscription & Payment**
   - **Monetization Model:** Opt for pay-per-lead or subscription-based models to access and manage leads.

---

## **5. Acceptance Criteria**

Acceptance criteria define the conditions that must be met for a feature to be considered complete and acceptable. They ensure clarity and alignment between stakeholders and the development team. The acceptance criteria for key features are as follows:

### **5.1 Consumer Journey Features**

1. **Landing Page**
   - **Postcode Entry Field:** Users can input a valid postcode.
   - **CTA Button:** The "Get Started" button is functional and redirects users to the next step.

2. **Service Selection**
   - Users can select at least one service before proceeding.

3. **Property and Energy Details**
   - All dropdown and input fields accept valid entries.

4. **Contact Information**
   - Users cannot proceed without entering a valid email and phone number.

5. **Submission Confirmation**
   - A thank-you message is displayed.
   - Users receive a confirmation email within 5 minutes.

---

## **6. Dependencies and Constraints**

- **Third-Party Integrations:** Email notifications via Supabase and potential CRM integrations for installers.
- **Legal Compliance:** Ensure compliance with data privacy laws.
- **Scalability:** System must handle growing traffic efficiently.

---

## **7. Resource References**

- Laravel TALL Stack Documentation
- Supabase API Documentation
- UX Best Practices for Lead Generation

---

This PRD provides a structured roadmap for developers to follow, ensuring clarity and efficiency in execution.

