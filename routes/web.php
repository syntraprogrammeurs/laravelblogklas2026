<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('frontend.home'))->name('frontend.home');
Route::get('/contact', fn () => view('frontend.contact'))->name('frontend.contact');

Route::get('/backend', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function(){
    Route::resource('/backend/users', UserController::class);
});


require __DIR__.'/settings.php';
