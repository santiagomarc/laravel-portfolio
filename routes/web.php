<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResumeController;

// Login routes
Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected resume routes (requires login)
Route::middleware('auth.custom')->group(function () {
    // OLD routes (keep for now)
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
    Route::get('/contact', [ResumeController::class, 'contact'])->name('contact');
    Route::post('/contact', [ResumeController::class, 'sendMessage'])->name('contact.send');
    
    // NEW routes for Activity 3
    Route::get('/dashboard', [ResumeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile/edit', [ResumeController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ResumeController::class, 'update'])->name('profile.update');
});

Route::get('/resume/{id}', [ResumeController::class, 'show'])->name('resume.public');

// alternative link public_resume.php?id=1
Route::get('/public_resume', function (Request $request) {
    $id = $request->query('id', 1); 
    return app(ResumeController::class)->show($id);
})->name('resume.public.query');