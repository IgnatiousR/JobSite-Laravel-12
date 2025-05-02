<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/jobs/search', [JobController::class,'search'])->name('job.search');
// Route::resource('jobs', JobController::class);
Route::resource('jobs', JobController::class)->middleware('auth')->only('create', 'edit', 'update', 'destroy');
Route::resource('jobs', JobController::class)->except('create', 'edit', 'update', 'destroy');

Route::middleware('guest')->group(function(){
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenicate'])->name('login.authenicate');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashBoardController::class,'index'])->name('dashboard');
    Route::put('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::get('/bookmarks', [BookmarkController::class,'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{job}', [BookmarkController::class,'store'])->name('bookmarks.store');
    Route::delete('/bookmarks/{job}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');
});

Route::post('/jobs/{job}/apply', [ApplicantController::class,'store'])->name('applicant.store')->middleware('auth');
Route::delete('/applicants/{applicant}', [ApplicantController::class,'destroy'])->name('applicant.destroy')->middleware('auth');
