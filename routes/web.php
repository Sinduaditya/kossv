<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Customer\BookingCustController;
use App\Http\Controllers\Customer\PaymentCustController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User Not Authenticated Route
Route::get('/kamar', [HomeController::class, 'rooms'])->name('home.kamar');
Route::get('/fasilitas', [HomeController::class, 'facility'])->name('home.facility');
Route::get('/kontak', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/', [HomeController::class, 'index'])->name('home');

// User Authenticated Route (Customer)
Route::middleware(['auth:customer'])->group(function () {
    // Routes untuk Payment
    Route::get('/payment/pay/{id}', [PaymentCustController::class, 'pay'])->name('payment.pay');
    // Route::get('/kamar', [HomeController::class, 'rooms'])->name('home.kamar');
    Route::get('/fasilitas', [HomeController::class, 'facility'])->name('home.facility');
    Route::get('/kontak', [HomeController::class, 'contact'])->name('home.contact');
    // Routes untuk Booking
    Route::get('/booking/reserve/{id}', [BookingCustController::class, 'reserve'])->name('booking.reserve');
    Route::post('/booking/store/{id}', [BookingCustController::class, 'store'])->name('bookingCust.store');
    Route::get('/booking/list/', [BookingCustController::class, 'list'])->name('booking.list');
    Route::delete('/bookingCust/{id}', [BookingCustController::class, 'destroy'])->name('bookingCust.destroy');
});

// User Routes Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login_user');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register_user');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout_user');

// Admin Routes Auth
Route::get('/login-admin', [AdminController::class, 'showLoginFormAdmin'])->name('login_admin');
Route::post('/login-admin', [AdminController::class, 'loginAdmin']);
Route::post('/logout-admin', [AdminController::class, 'logoutAdmin'])->name('logout_admin');

// Rute dashboard admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('booking', BookingController::class);
    Route::resource('payment', PaymentController::class);
    Route::resource('room', RoomController::class);
    Route::resource('customer', CustomerController::class);
});
