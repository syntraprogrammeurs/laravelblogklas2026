<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//frontend routes

Route::get('/', fn () => view('frontend.home'))->name('home');
Route::get('/contact', fn () => view('frontend.contact'))->name('frontend.contact');

//backend routes
Route::get('/backend', function () {
    return view('backend.dashboard');
})->middleware(['auth', 'verified'])->name('backend.dashboard');



Route::middleware(['auth'])->group(function(){

    Route::get('/backend/contact', fn () => view('backend.contact'))->name('backend.contact');
});

//Route::get('/backend/users', function(){
//    return view('backend.users.index');
//})->middleware(['auth', 'verified'])->name('backend.users.index');

Route::get('/backend/users',[UserController::class, 'index'])
    ->middleware(['auth','verified'])
    ->name('backend.users.index');

require __DIR__.'/settings.php';
