<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\acccontroller;
use App\Http\Controllers\recipecontroller;
use App\Http\Controllers\membercontroller;
use App\Http\Middleware\EditRecipe;
use App\Http\Controllers\adscontroller;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\ViewEditRecipeandDonations;
use App\Http\Middleware\SimpleRole;
use App\Http\Middleware\DeleteRecipe;
use App\Http\Controllers\HomeController;

Route::get('/',[HomeController::class,'fullviewrecipe'])->name('homepage');
Route::get('/homepage',[HomeController::class,'fullviewrecipe'])->name('homepage');

Route::get('/aboutus',function(){
    return view('aboutus');
})->name('aboutus');

Route::get('/contactus',function(){
    return view('contactus');
})->name('contactus');

Route::get('/menu',function(){
    return view('menupage');
})->name('menu');

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
Route::post('/createmenu',[recipecontroller::class,'createrecipe'])->name('recipecreation')->middleware(SimpleRole::class.':restaurant');
Route::get('/createmenu',function(){ return view('createmenu');})->name('recipecreatepage')->middleware(SimpleRole::class.':restaurant');
Route::get('/logout',[acccontroller::class,'logout'])->name('logout');
Route::post('/adminregist',[acccontroller::class,'createadmin'])->name('adminregist');
Route::post('/restoregist',[acccontroller::class,'createresto'])->name('restoregist');
Route::post('/menudashboard',[recipecontroller::class,'searchrecipe'])->name('searchrecipe');
Route::post('/restoprofile',[acccontroller::class,'updaterestoprofile']);
Route::get('/adminregist',function(){
    return view('adminregister');
});
Route::post('/userprofile',[acccontroller::class,'updateuserprofile'])->middleware(SimpleRole::class.':user');
Route::post('/useracc',[acccontroller::class,'upuseraccount'])->name('upuseracc')->middleware(SimpleRole::class.':user');
Route::get('/subscription',[membercontroller::class,'subscription'])->name('subscription');
Route::get('/editrecipe/{i}',[recipecontroller::class,'recipeeditpage'])->name('editrecipe')->middleware(ViewEditRecipeandDonations::class.':recipe');
Route::post('/editrecipe/{i}',[recipecontroller::class,'updaterecipe'])->name('updaterecipe')->middleware(EditRecipe::class);
Route::get('/ads',[adscontroller::class,'addashboard'])->name('addashboard')->middleware(SimpleRole::class.':admin');
Route::get('/myrecipes',[recipecontroller::class,'allmyrecipes'])->name('allmyrecipes')->middleware(SimpleRole::class.':restaurant');
Route::post('/subscription',[membercontroller::class,'subscribe'])->name('subscribe')->middleware(SimpleRole::class.':user');
Route::post('/refill',[membercontroller::class,'refillbalance'])->name('refillacc')->middleware(SimpleRole::class.':user');
Route::get('/admrecipes',[recipecontroller::class,'admrecipes'])->name('admrecipes')->middleware(SimpleRole::class.':admin');
Route::post('/createads',[adscontroller::class,'createads'])->name('createads')->middleware(SimpleRole::class.':admin');
Route::get('/deleterecipe/{id}',[recipecontroller::class,'recipedelete'])->name('deleterecipe')->middleware(DeleteRecipe::class);
Route::get('/deletead/{id}',[adscontroller::class,'deletead'])->name('deletead')->middleware(SimpleRole::class.':admin');
Route::get('/editad/{id}',[adscontroller::class,'editadview'])->name('editadview')->middleware(SimpleRole::class.':admin');
Route::post('/editad/{id}',[adscontroller::class,'editad'])->name('editad')->middleware(SimpleRole::class.':admin');
Route::get('/donations',[DonationController::class,'viewalldonations'])->name('donate');
Route::get('/createdonation',[DonationController::class,'createdonationview'])->name('createdonationview');
Route::post('/createdonation',[DonationController::class,'createdonation'])->name('createdonation');
Route::get('/deletedonation/{id}',[DonationController::class,'deletedonation'])->name('deletedonation')->middleware(ViewEditRecipeandDonations::class.':donation');
Route::get('/viewdonation/{id}',[DonationController::class,'viewdonation'])->name('viewdonation');
Route::post('/donations',[DonationController::class,'searchdonations'])->name('searchdonations');
Route::post('/viewdonation/{id}',[TransactionController::class,'addtransaction'])->name('addtransaction')->middleware(SimpleRole::class.':user');
Route::get('/transaction',[TransactionController::class,'viewactivetransaction'])->name('viewtransaction')->middleware(SimpleRole::class.':user');
Route::post('/transaction',[TransactionController::class,'edittransactionitem'])->name('edittransactionitem')->middleware(SimpleRole::class.':user');
Route::post('/deletetransaction',[TransactionController::class,'deletetransactionitem'])->name('deletetransactionitem')->middleware(SimpleRole::class.':user');
Route::post('/confirmtransaction',[TransactionController::class,'confirmtransaction'])->name('confirmtransaction')->middleware(SimpleRole::class.':user');
Route::get('/editdonation/{id}',[DonationController::class,'editdonationview'])->name('editdonationview')->middleware(ViewEditRecipeandDonations::class.':donation');
Route::post('/editdonation/{id}',[DonationController::class,'editdonation'])->name('editdonation')->middleware(ViewEditRecipeandDonations::class.':donation');
Route::post('/restoacc',[acccontroller::class,'uprestoacc'])->name('uprestoacc')->middleware(SimpleRole::class.':restaurant');
Route::post('/adminacc',[acccontroller::class,'upadminacc'])->name('upadminacc')->middleware(SimpleRole::class.':admin');
Route::post('/adminprofile',[acccontroller::class,'updateadminprofile'])->name('upadminprofile')->middleware(SimpleRole::class.':admin');