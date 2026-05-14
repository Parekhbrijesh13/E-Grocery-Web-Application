<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdmindashboardController, AuthController, CategoryController, HomeController, InventoryController, ProductController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home Page Routes

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('home/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('home/about', [HomeController ::class, 'about'])->name('home.about');

// Auth Routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login/authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register/store', [AuthController::class, 'store'])->name('register.store');


/*ADMIN ROUTES*/
Route::middleware(['auth'])->group(function () {
    Route::get('admin/dashboard', [AdmindashboardController::class, 'index'])->name('admin.dashboard');

    // Products Routes
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('admin/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('admin/products/{product}', [ProductController::class, 'delete'])->name('admin.products.delete');

    // Inventory Routes
    Route::get('admin/inventory', [InventoryController::class, 'index'])->name('admin.inventory.index');
    Route::post('admin/inventory/products/{product}/adjust', [InventoryController::class, 'adjust'])->name('admin.inventory.adjust');

    // Categories Routes
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::put('categories/update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/delete/{id}',[CategoryController::class,'delete'])->name('admin.categories.delete');

    // Customers Routes
    Route::get('admin/customers', [App\Http\Controllers\CustomerController::class, 'index'])->name('admin.customers.index');
    Route::post('admin/customers/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('admin.customers.store');
    Route::put('admin/customers/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('admin/customers/{id}', [App\Http\Controllers\CustomerController::class, 'delete'])->name('admin.customers.delete');

    // Banners Routes
    Route::get('admin/banners', [App\Http\Controllers\BannerController::class, 'index'])->name('admin.banners.index');
    Route::post('admin/banners/store', [App\Http\Controllers\BannerController::class, 'store'])->name('admin.banners.store');
    Route::put('admin/banners/{id}', [App\Http\Controllers\BannerController::class, 'update'])->name('admin.banners.update');
    Route::delete('admin/banners/{id}', [App\Http\Controllers\BannerController::class, 'delete'])->name('admin.banners.delete');

    // Coupons Routes
    Route::get('admin/coupons', [App\Http\Controllers\CouponController::class, 'index'])->name('admin.coupons.index');
    Route::post('admin/coupons/store', [App\Http\Controllers\CouponController::class, 'store'])->name('admin.coupons.store');
    Route::put('admin/coupons/{id}', [App\Http\Controllers\CouponController::class, 'update'])->name('admin.coupons.update');
    Route::delete('admin/coupons/{id}', [App\Http\Controllers\CouponController::class, 'delete'])->name('admin.coupons.delete');

    // Offers Routes
    Route::get('admin/offers', [App\Http\Controllers\OfferController::class, 'index'])->name('admin.offers.index');
    Route::post('admin/offers/store', [App\Http\Controllers\OfferController::class, 'store'])->name('admin.offers.store');
    Route::put('admin/offers/{id}', [App\Http\Controllers\OfferController::class, 'update'])->name('admin.offers.update');
    Route::delete('admin/offers/{id}', [App\Http\Controllers\OfferController::class, 'delete'])->name('admin.offers.delete');

    // Settings Routes
    Route::get('admin/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('admin.settings.index');
    Route::put('admin/settings/update', [App\Http\Controllers\SettingController::class, 'update'])->name('admin.settings.update');

    // Profile Routes
    Route::get('admin/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('admin.profile.index');
    Route::put('admin/profile/update', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('admin/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('admin.profile.password');
});
