<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PromocodeController;
use App\Http\Controllers\MotorcycleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Frontend\PaymentCallbackController;
use App\Http\Controllers\XenditWebhookController;

use App\Livewire\Frontend\HomePage;
use App\Livewire\Frontend\MotorcycleDetail;
use App\Livewire\Frontend\MotorcycleSearch;
use App\Livewire\Frontend\CustomerProfile;
use App\Livewire\Frontend\BookingHistory;
use App\Livewire\Frontend\AboutPage;
use App\Livewire\Frontend\ContactPage;

// ==========================
// 🔓 Public Frontend Routes
// ==========================
Route::get('/', HomePage::class)->name('home');
Route::get('/motorcycles', MotorcycleSearch::class)->name('frontend.motorcycles.index');
Route::get('/motorcycles/{slug}', MotorcycleDetail::class)->name('frontend.motorcycles.show');
Route::get('/about', AboutPage::class)->name('frontend.about');
Route::get('/contact', ContactPage::class)->name('frontend.contact');

// ==========================
// 🔐 Authenticated User Routes
// ==========================
Route::middleware(['auth'])->group(function () {
    Route::get('/my-profile', CustomerProfile::class)->name('frontend.profile');
    Route::get('/bookings', BookingHistory::class)->name('frontend.bookings');

    // Payment redirect callbacks
    // Route::get('/payment/success', [PaymentCallbackController::class, 'paymentSuccess'])->name('frontend.payment.callback');
    // Route::get('/payment/failure', [PaymentCallbackController::class, 'paymentFailure'])->name('frontend.payment.failure');
});

// ==========================
// 🌐 (Optional) Xendit Webhook Endpoint
// ==========================
Route::post('/webhook/xendit', [XenditWebhookController::class, 'handle'])->name('xendit.webhook');

// ==========================
// 📊 Dashboard Redirect
// ==========================
Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ==========================
// 👤 Profile Routes (Breeze/Jetstream)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================
// 🛠️ Admin Panel Routes (role:admin)
// ==========================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn () => view('admin.dashboard'))->name('dashboard');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('brands', BrandController::class);
        Route::resource('locations', LocationController::class);
        Route::resource('promocodes', PromocodeController::class);
        Route::resource('motorcycles', MotorcycleController::class);
        Route::resource('users', UserController::class);
        Route::resource('bookings', BookingController::class);
    });

// ==========================
// 🔐 Auth Routes (Breeze)
// ==========================
require __DIR__.'/auth.php';
