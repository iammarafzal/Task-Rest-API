<?php

use App\Models\User;
use App\Models\Profile;
use App\Models\Posts;
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

// Route Products
Route::view('/create-product', 'product.create');
Route::view('/all-products', 'product.list')->name('product.view');
Route::get('/edit-product/{id}', function ($id){
    return view('product.edit', ['id' => $id]);
});


// Route Users 
Route::get('create-user', function (){
    $user = User::create([
        'name' => 'Ammar Afzal',
        'email' => 'ammarafzal@gmail.com',
        'password' => bcrypt('password'),
    ]);

    $profile = Profile::create([
        'user_id' => $user->id,
        'phone' => '1234567890',
        'address' => 'Street 1, Islamabad',
        'city' => 'Islamabad',
    ]);

    $post1 = Posts::create([
        'user_id' => $user->id,
        'title' => 'My First Post',
        'body' => 'This is the body of my first post.',
    ]);

    Posts::class::create([
        'user_id' => $user->id,
        'title' => 'My Second Post',
        'body' => 'This is the body of my second post.',
    ]);
    return 'User and Profile Created';
});


?>



