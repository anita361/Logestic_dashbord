<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\SqlActionController;

// ---------------- Dashboard ----------------
Route::get('/', function () {
    return view('login');
})->name('dashbord');

// ---------- Login ----------
Route::get('/login/form', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// ---------- Register ----------
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('signup');
Route::post('/register', [UserController::class, 'register'])->name('register.post');
Route::post('/registersql', [UserController::class, 'registerWithSQL'])->name('register.sql');

// Google
Route::get('/auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);
// Route::post('/logout', [SocialLoginController::class, 'logout'])->name('logout');

// Apple
// Route::get('/auth/apple', [SocialLoginController::class, 'redirectToApple'])->name('auth.apple.redirect');
// Route::get('/auth/apple/callback', [SocialLoginController::class, 'handleAppleCallback'])->name('auth.apple.redirect');



// ---------- Dashboard ----------
Route::get('/dashboard', function() {
    return view('index');
})->name('dashboard');



// ---------------- Customer Routes ----------------
Route::prefix('customer')->group(function () {
    Route::get('/customer-list', [SqlActionController::class, 'customer_get_data'])->name('customer-list');
    Route::get('/EditLoadCustomer/add_edit/{id}', [SqlActionController::class, 'EditLoadCustomer'])->name('EditLoadCustomer');
    Route::get('/AddLoadCustomer', [SqlActionController::class, 'AddLoadCustomer_form'])->name('AddLoadCustomer');
    Route::post('/AddLoadCustomer_query', [SqlActionController::class, 'AddLoadCustomer_query'])->name('AddLoadCustomer_query');
    Route::post('/update_customer', [SqlActionController::class, 'update_customer'])->name('update_customer');
});

// ---------------- Shipper Routes ----------------
Route::prefix('shipper')->group(function () {
    Route::get('/shipper-list', [SqlActionController::class, 'shipper_get_data'])->name('shipper-list');
    Route::get('/add_shipper', [SqlActionController::class, 'add_shipper_form'])->name('add_shipper');
    Route::post('/add_shipper_query', [SqlActionController::class, 'add_shipper_query'])->name('add_shipper_query');
    Route::get('/shipper/add_edit/{id}', [SqlActionController::class, 'edit_shipper'])->name('edit_shipper');
    Route::post('/update_shipper', [SqlActionController::class, 'update_shipper'])->name('update_shipper');
    Route::get('/get-shipper-location/{id}', [SqlActionController::class, 'getshipperLocation'])->name('get_shipper_location');
});

// ---------------- Consignee Routes ----------------
Route::prefix('consignee')->group(function () {
    Route::get('/consignee-list', [SqlActionController::class, 'consignee_get_data'])->name('consignee-list');
    Route::get('/add_consignee', [SqlActionController::class, 'add_consignee_form'])->name('add_consignee');
    Route::post('/add_consignee_query', [SqlActionController::class, 'add_consignee_query'])->name('add_consignee_query');
    Route::get('/consign/add_edit/{id}', [SqlActionController::class, 'edit_consign'])->name('edit_consign');
    Route::post('/update_consignee', [SqlActionController::class, 'update_consignee'])->name('update_consignee');
    Route::get('/get-consignee-location/{id}', [SqlActionController::class, 'getconsigneeLocation'])->name('get_consignee_location');
});

// ---------------- MC Check Routes ----------------
Route::prefix('mc-check')->group(function () {
    Route::get('/mc-check-list', [SqlActionController::class, 'mc_get_data'])->name('mc-check-list');
    Route::get('/add-mc-check', [SqlActionController::class, 'add_mc_form'])->name('add-mc-check');
    Route::post('/add_mc_query', [SqlActionController::class, 'add_mc_query'])->name('add_mc_query');
    Route::get('/edit_mc/add_edit/{id}', [SqlActionController::class, 'edit_mc'])->name('edit_mc');
    Route::post('/update_mc', [SqlActionController::class, 'update_mc'])->name('update_mc');
});

// ---------------- Carrier Routes ----------------
Route::prefix('carrier')->group(function () {
    Route::get('/external_carrier', [SqlActionController::class, 'external_carrier'])->name('external_carrier');
    Route::get('/add_carrier', [SqlActionController::class, 'add_carrier'])->name('add_carrier');
    Route::post('/add_carrier_query', [SqlActionController::class, 'add_carrier_query'])->name('add_carrier_query');
    Route::get('/edit_carrier/carrier_edit/{id}', [SqlActionController::class, 'edit_carrier'])->name('edit_carrier');
    Route::post('/update_carrier_query', [SqlActionController::class, 'update_carrier_query'])->name('update_carrier_query');
});

// ---------------- Load Creation Routes ----------------
Route::prefix('load-creation')->group(function () {
    Route::get('/', [SqlActionController::class, 'load_creation'])->name('load-creation');
    Route::get('/add-load-creation', [SqlActionController::class, 'add_load_creation'])->name('add-load-creation');
    Route::post('/add_load_creation_query', [SqlActionController::class, 'add_load_creation_query'])->name('add_load_creation_query');
    Route::get('/edit_load_creation/edit_load/{id}', [SqlActionController::class, 'edit_load_creation'])->name('edit_load_creation');
    Route::post('/update-load-status', [SqlActionController::class, 'updateStatus'])->name('load_updateStatus');
    Route::post('/update_load_query', [SqlActionController::class, 'update_load_query'])->name('update_load_query');
});

// ---------------- States Route ----------------
Route::get('/states', [SqlActionController::class, 'getStates'])->name('states.get');
