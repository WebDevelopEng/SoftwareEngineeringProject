<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\acccontroller;
use App\Http\Controllers\recipecontroller;
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
    return view('profilepage');
})->name('profile');
Route::get('/register',function(){
    return view('registpage');
})->name('register');

Route::post('/register',[acccontroller::class,'create_account'])->name('registacc');
Route::get('/recipes',function(){
    return view('templates.headandfoot');
});
Route::get('/login', function(){
    return view('loginpage');
})->name('login');
Route::post('/login',[acccontroller::class,'login_account'])->name('loginacc');
Route::get('/menudashboard',[recipecontroller::class,'fullviewrecipe'])->name('menudashboard');
Route::post('/createmenu',[recipecontroller::class,'createrecipe'])->name('recipecreation');
Route::get('/createmenu',function(){ return view('createmenu');})->name('recipecreatepage');
Route::get('/logout',[acccontroller::class,'logout'])->name('logout');