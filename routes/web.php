<?php

use Illuminate\Support\Facades\Route;

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

})->name('register');

Route::post('/register',[])->name('registacc');