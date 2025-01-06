<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\CartControlle;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ContactController;



Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::prefix('front')->name('front.')->group(function() { 
   
     Route::get('product', [FrontController::class, 'product'])->name('product');
     Route::get('product/{id}', [FrontController::class, 'single_product'])->name('single_product');
     Route::get('blog_list', [FrontController::class, 'blog_list'])->name('blog_list');
     Route::get('about', [FrontController::class, 'about'])->name('about');
     Route::get('contact', [FrontController::class, 'contact'])->name('contact');
     Route::post('cart/{id}', [CartControlle::class, 'store_cart'])->middleware('auth')->name('store_cart'); 
     Route::get('cart', [CartControlle::class, 'mycart'])->name('mycart');
     Route::delete('cart/{id}', [CartControlle::class, 'remove_cart'])->name('remove_cart');
     Route::post('order', [OrderController::class, 'complete_order'])->name('complete_order');
     Route::post('contact', [ContactController::class, 'store_contact'])->name('store_contact');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
