<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// 1. GET Deleted Tasks
Route::get('tasks/deleted', [TaskController::class, 'deleted']);

// 2. Restore Task
Route::post('tasks/{id}/restore', [TaskController::class, 'restore']);

// 3. Update Reminder
Route::patch('tasks/{task}/reminder', [TaskController::class, 'updateReminder']);

// 4. Standard Routes
Route::apiResource('tasks', TaskController::class);