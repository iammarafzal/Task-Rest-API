<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

// Route::get('/product/create',[ProductController::class, 'create'])->name('product.create');

Route::get('/product/create', 'App\Http\Controllers\ProductController@create')->name('product.create');

Route::post('/product', 'App\Http\Controllers\ProductController@store')->name('product.store');

Route::get('/product', 'App\Http\Controllers\ProductController@index')->name('product.index');

Route::get('/product/{id}/edit', 'App\Http\Controllers\ProductController@edit')->name('product.edit');

Route::put('/product/{product}', [ProductController::class, 'update'])->name('product.update');  

Route::delete('/product/{product}', [ProductController::class, 'destroy'])->name('product.destroy');

?>



