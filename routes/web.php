<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;

// routes/web.php
Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/projects', [ProjectController::class, 'allProjects'])->name('projects.all');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show')->where('slug', '[a-z0-9\-]+');
Route::get('/category/{slug}', [ProjectController::class, 'category'])->name('projects.category')->where('slug', '[a-z0-9\-]+');
Route::get('/search', [ProjectController::class, 'search'])->name('projects.search');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
