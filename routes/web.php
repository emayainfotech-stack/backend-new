<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CityController;

Route::get('/', function () {
    return view('landing');
});

// Public legal pages
Route::view('/terms-and-conditions', 'public.terms')->name('public.terms');
Route::view('/privacy-policy', 'public.privacy')->name('public.privacy');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/reporter', [DashboardController::class, 'reporter'])->name('dashboard.reporter');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
    Route::get('/get-cities/{state_id}', [CityController::class, 'getCitiesByState'])->name('cities.by-state');
    Route::put('/news/{id}/status', [NewsController::class, 'updateStatus'])->name('news.updateStatus');
    Route::view('/create-skill', 'create-skill')->name('create-skill');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index')->middleware('role:admin,reporter');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create')->middleware('role:admin,reporter');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store')->middleware('role:admin,reporter');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit')->middleware('role:admin,reporter');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update')->middleware('role:admin,reporter');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy')->middleware('role:admin,reporter');
    
    Route::view('/form-validation', 'form-validation')->name('form-validation');
});
