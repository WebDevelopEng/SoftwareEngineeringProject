<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\acccontroller;
use App\Http\Controllers\recipecontroller;
use App\Http\Controllers\membercontroller;
use App\Http\Middleware\EditRecipe;
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

Route::get('/subscribe',function(){

})->name('subscribe');

Route::get('/profile', [acccontroller::class,'viewallprofile']
)->name('profile');
Route::get('/register',function(){
    return view('registpage');
})->name('register');

Route::post('/register',[acccontroller::class,'create_account'])->name('registacc');
Route::get('/viewrecipe/{recipeid}',[recipecontroller::class,'viewparticularrecipe']
);
Route::get('/login', 
    [acccontroller::class,'loginonce'])->name('login');
Route::post('/login',[acccontroller::class,'login_account'])->name('loginacc');
Route::get('/menudashboard',[recipecontroller::class,'fullviewrecipe'])->name('menudashboard');
Route::post('/createmenu',[recipecontroller::class,'createrecipe'])->name('recipecreation');
Route::get('/createmenu',function(){ return view('createmenu');})->name('recipecreatepage');
Route::get('/logout',[acccontroller::class,'logout'])->name('logout');
Route::post('/adminregist',[acccontroller::class,'createadmin'])->name('adminregist');
Route::post('/restoregist',[acccontroller::class,'createresto'])->name('restoregist');
Route::post('/menudashboard',[recipecontroller::class,'searchrecipe'])->name('searchrecipe');
Route::post('/restoprofile',[acccontroller::class,'updateresto']);
Route::get('/adminregist',function(){
    return view('adminregister');
});
Route::post('/userprofile',[acccontroller::class,'updateuserprofile']);
Route::post('/useracc',[acccontroller::class,'upuseraccount'])->name('upuseracc');
Route::get('/subscription',[membercontroller::class,'subscription'])->name('subscription');
Route::post('/subscription',[membercontroller::class,'createsub'])->name('createsub');
Route::get('/editpage/{i}',[recipecontroller::class,'recipeeditpage'])->name('editrecipe');