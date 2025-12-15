<?php

use App\Models\User;
use App\Models\Profile;
use App\Models\Posts;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route:: resource('product', ProductController::class);

Route::view('/', 'welcome')->name('home');

Route::get('/page2', function () {
    return view('page2');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/Apage', function () {
    return view('Apage');
});

Route::get('/example', function () {
    return view('example');
});

// Route Products
Route::view('/create-product', 'product.create');
Route::view('/all-products', 'product.list')->name('product.view');
Route::get('/edit-product/{id}', function ($id){
    return view('product.edit', ['id' => $id]);
});



?>



