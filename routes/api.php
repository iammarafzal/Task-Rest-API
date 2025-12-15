<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

// Task Routes
Route::get('tasks/deleted', [TaskController::class, 'deleted']);
Route::post('tasks/{id}/restore', [TaskController::class, 'restore']);
Route::patch('tasks/{task}/reminder', [TaskController::class, 'updateReminder']);
Route::apiResource('tasks', TaskController::class);

// Product Routes 
// Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
// Route::post('products', ProductController::class, 'store')->name('product.store');
// Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
// Route::put('product/{id}', [ProductController::class, 'update'])->name('product.update');
// Route::delete('product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::apiResource('/products', ProductController::class);

// 1. Route to CREATE the data
Route::post('/create-user', [UserController::class, 'store']);

// 2. Route to VIEW the data (e.g., /user/1)
Route::get('/user/{id}', [UserController::class, 'show']);