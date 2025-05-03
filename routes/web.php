<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\acccontroller;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/landingpage',function(){
    return view('landingpage');
});

Route::get('/homepage',function(){
    return view('homepage');
});

Route::get('/menu',function(){
    return view('menupage');
})->name('menu');

Route::get('/bookmarks',function(){
})->name('bookmarks');

Route::get('/donate',function(){
})->name('donate');

Route::get('/restaurants', function(){

})->name('restaurants');

Route::get('/login',function(){

})->name('login');

Route::get('/profile', function(){

})->name('profile');

Route::get('/register',function(){
    return view('registpage');
})->name('register');

Route::post('/register',[acccontroller::class,'create_account'])->name('registacc');