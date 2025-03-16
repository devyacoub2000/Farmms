<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CartControlle;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ContactController;


Route::prefix(LaravelLocalization::setLocale())->middleware('auth', 'is_admin', 'verified')->group(function() {
Route::prefix('admin')->name('admin.')->group(function() {
   
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('category', CategoryController::class);
    Route::resource('product',  ProductController::class);
    // Profile Page 
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');   
    Route::put('profile', [AdminController::class, 'profile_data'])->name('profile_data'); 
    Route::post('check-password', [AdminController::class, 'check_password'])
    ->name('check_password'); 

    // Cart And Orders

    Route::get('orders', [OrderController::class, 'all_orders'])->name('all_orders');
    Route::get('orders/{id}', [OrderController::class, 'show_order'])->name('show_order');

   // Contacts

   Route::get('contacts', [ContactController::class, 'contacts'])->name('contacts');

   // Settings 
   Route::get('settings', [AdminController::class, 'settings'])->name('settings');
   Route::put('settings', [AdminController::class, 'save_settings'])->name('save_settings');

   Route::get('deleimg-site', [AdminController::class, 'deleimg_site'])->name('deleimg_site');








   
});
});