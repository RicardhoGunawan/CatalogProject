<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController; // Tambahkan ini

// routes/web.php
Route::get('/', [ProjectController::class, 'index'])->name('home');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/category/{name}', [ProjectController::class, 'category'])->name('projects.category');
