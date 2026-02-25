<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//frontend routes

Route::get('/', fn () => view('frontend.home'))->name('home');
Route::get('/contact', fn () => view('frontend.contact'))->name('frontend.contact');

//backend routes
Route::get('/backend', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware(['auth'])->group(function(){
    Route::resource('/backend/users', UserController::class);
});




require __DIR__.'/settings.php';
