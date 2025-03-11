<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConsumerController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Consumer routes
Route::prefix('consumer')->name('consumer.')->group(function () {
    Route::get('/', [ConsumerController::class, 'index'])->name('index');
    Route::post('/validate-postcode', [ConsumerController::class, 'validatePostcode'])->name('validate-postcode');
    Route::get('/service-selection', [ConsumerController::class, 'serviceSelection'])->name('service-selection');
    Route::post('/service-selection', [ConsumerController::class, 'storeServices'])->name('store-services');
    Route::get('/property-details', [ConsumerController::class, 'propertyDetails'])->name('property-details');
    Route::post('/property-details', [ConsumerController::class, 'storePropertyDetails'])->name('store-property-details');
    Route::get('/contact-information', [ConsumerController::class, 'contactInformation'])->name('contact-information');
    Route::post('/contact-information', [ConsumerController::class, 'storeContactInformation'])->name('store-contact-information');
    Route::get('/additional-details', [ConsumerController::class, 'additionalDetails'])->name('additional-details');
    Route::post('/additional-details', [ConsumerController::class, 'storeAdditionalDetails'])->name('store-additional-details');
    Route::get('/confirmation', [ConsumerController::class, 'confirmation'])->name('confirmation');
});

// Provider routes
Route::get('/provider/register', [ProviderController::class, 'register'])->name('provider.register');
Route::post('/provider/register', [ProviderController::class, 'storeRegistration'])->name('provider.store-registration');

// Provider authenticated routes
Route::middleware(['auth'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [ProviderController::class, 'profile'])->name('profile');
    Route::post('/profile', [ProviderController::class, 'updateProfile'])->name('update-profile');
    Route::get('/leads', [ProviderController::class, 'leads'])->name('leads');
    Route::get('/leads/{id}', [ProviderController::class, 'showLead'])->name('lead');
    Route::post('/leads/{leadId}/quote', [ProviderController::class, 'submitQuote'])->name('submit-quote');
    Route::get('/messages/{leadId?}', [ProviderController::class, 'messages'])->name('messages');
    Route::post('/messages/{leadId}', [ProviderController::class, 'sendMessage'])->name('send-message');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Lead management
    Route::get('/leads', [AdminController::class, 'leads'])->name('leads.index');
    Route::get('/leads/{id}', [AdminController::class, 'showLead'])->name('leads.show');
    Route::post('/leads/{id}/assign', [AdminController::class, 'assignProviders'])->name('leads.assign');
    
    // Provider management
    Route::get('/providers', [AdminController::class, 'providers'])->name('providers.index');
    Route::get('/providers/{id}', [AdminController::class, 'showProvider'])->name('providers.show');
    Route::post('/providers/{id}/approve', [AdminController::class, 'approveProvider'])->name('providers.approve');
    
    // Region management
    Route::get('/regions', [AdminController::class, 'regions'])->name('regions.index');
    Route::get('/regions/create', [AdminController::class, 'createRegion'])->name('regions.create');
    Route::post('/regions', [AdminController::class, 'storeRegion'])->name('regions.store');
    Route::get('/regions/{id}/edit', [AdminController::class, 'editRegion'])->name('regions.edit');
    Route::put('/regions/{id}', [AdminController::class, 'updateRegion'])->name('regions.update');
    
    // Service management
    Route::get('/services', [AdminController::class, 'services'])->name('services.index');
    Route::get('/services/create', [AdminController::class, 'createService'])->name('services.create');
    Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
    Route::get('/services/{id}/edit', [AdminController::class, 'editService'])->name('services.edit');
    Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('services.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
