<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\acccontroller;
use App\Http\Controllers\recipecontroller;
use App\Http\Controllers\membercontroller;
use App\Http\Middleware\EditRecipe;
use App\Http\Controllers\adscontroller;
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
)->name('viewrecipe');
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
Route::post('/restoprofile',[acccontroller::class,'updaterestoprofile']);
Route::get('/adminregist',function(){
    return view('adminregister');
});
Route::post('/userprofile',[acccontroller::class,'updateuserprofile']);
Route::post('/useracc',[acccontroller::class,'upuseraccount'])->name('upuseracc');
Route::get('/subscription',[membercontroller::class,'subscription'])->name('subscription');
Route::get('/editrecipe/{i}',[recipecontroller::class,'recipeeditpage'])->name('editrecipe');
Route::post('/editrecipe/{i}',[recipecontroller::class,'updaterecipe'])->name('updaterecipe')->middleware(EditRecipe::class);
Route::get('/ads',[adscontroller::class,'addashboard'])->name('addashboard');
Route::get('/myrecipes',[recipecontroller::class,'allmyrecipes'])->name('allmyrecipes');
Route::post('/subscription',[membercontroller::class,'subscribe'])->name('subscribe');
Route::post('/refill',[membercontroller::class,'refillbalance'])->name('refillacc');
Route::get('/admdonations',[donationscontroller::class,'admdonations'])->name('admdonations');
Route::get('/admrecipes',[recipecontroller::class,'admrecipes'])->name('admrecipes');
Route::post('/createads',[adscontroller::class,'createads'])->name('createads');
Route::get('/deleterecipe/{id}',[recipecontroller::class,'recipedelete'])->name('deleterecipe');
Route::get('/deletead/{id}',[adscontroller::class,'deletead'])->name('deletead');
Route::get('/editad/{id}',[adscontroller::class,'editadview'])->name('editadview');
Route::post('/editad/{id}',[adscontroller::class,'editad'])->name('editad');
