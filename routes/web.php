<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResumeController;

// Login routes
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected resume routes
Route::middleware('auth.custom')->group(function () {
    Route::get('/resume', [ResumeController::class, 'index'])->name('resume');
    Route::get('/contact', [ResumeController::class, 'contact'])->name('contact');
    Route::post('/contact', [ResumeController::class, 'sendMessage'])->name('contact.send');
});