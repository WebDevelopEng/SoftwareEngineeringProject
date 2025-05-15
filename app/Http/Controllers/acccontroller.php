<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Restaurant;
use App\Models\admin;
class acccontroller extends Controller
{
    //
    function create_account(Request $req){
        $req->validate([
            'name'=>'required|max:50',
            'dob'=>['required','before:today','date'],
            'email'=>'email|required|unique:users,email',
            'password'=>'required',
        ],
    ['email.required'=>"You must input your email address.",
      'dob.required'=>"You must input your date of birth.",
    'password.required'=>"You must input a password.",
    'name.unique'=>"Username has already been taken. Please create a new username.",
    'name.max'=>"Username is too long. Please use a shorter username",
    'dob.before'=>"Please enter a valid birthdate."  ]);
    $account = new User;
    $account->name=$req->name;
    $account->dateofbirth=$req->dob;
    $account->password=$req->password;
    $account->email=$req->email;
    $account->balance=0;
    $account->save();
    return redirect('/menu');
    }
    function login_account(Request $req){
        $req->validate([
            'email'=>'email|required',
            'password'=>'required'
        ],
        ['email.required'=>"Please input a valid email address.",
        'password.required'=>"Please input a password."]
    );
    if($req->hidden=="userselection"){
    $currentuser=User::where('email',$req->email)->first();
    if ($currentuser != null && Hash::check($req->password,$currentuser->password)){
        session(['user'=>$currentuser]);
        return redirect('/menu');
    }
    else{
        return view('loginpage',['errormessage'=>'login failed']);
    }
    }
    if($req->hidden=="restoselection"){
        $currentuser=Restaurant::where('restaurantEmail',$req->email)->first();
    if($currentuser!= null && $currentuser->password==$req->password){
        session(['restaurant'=>$currentuser]);
        return redirect('/menu');
    }
    else{
        return view('loginpage',['errormessage'=>'login failed']);
    }
    }
    if($req->hidden=="adminselection"){
        $currentuser=Admin::where('email',$req->email)->first();
    if($currentuser!=null && $currentuser->password==$req->password){
        session(['admin'=>$currentuser]);
        return redirect('/menu');
    }
    else{
        return view('loginpage',['errormessage'=>'login failed']);
    }
    }
    }
    function updateaccount(){
        if(session('user')!=null){
            $account=User::find(session('user')->id);
            $account->name=$req->name;
            $account->password=$req->password;
            $account->email=$req->email;
            $account->dob=$req->dob;
            $account->save();
            return redirect('/profile');
        }
        return redirect('/login');
    }
    function deleteaccount(){
        
    }
    function logout(){
        Session::flush();
        return redirect('/menudashboard');
    }

    function restaurantregister(){

    }
    function profilepage(){
        if (!Session::get('user')){
            
        }
        if(!Session::get('restaurant')){

        }
        if(!Session::get('admin')){

        }
    }
    function uploadprofilepicture(Request $req){
        if($req->picture!=null){
            if(Session::get('user')){
                $currentuserid=Session::get('user');
                $string='use';
            }
            if(Session::get('restaurant')){
                $currentuserid=Session::get('restaurant');
                $string='rest';
            }
            if(Session::get('admin')){
                $currentuserid=Session::get('admin');
                $string='adm';
            }
            $extension=$req->picture->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat=$string.$currentuserid.$currenttime.'.'.$extension;
            $req->picture->storeAs('/profileimage',$stringformat,'public');
            $profile->picture=$stringformat;
            $profile->save();
            return view('profilepage',['profile'=>$profile]);
        }
    }
    function viewprofile(){
        if(Session::get('user')){
            $userid=Session::get('user');
            $currentuser=User::find($userid);
            return view('profilepage',['user'=>$currentuser]);
        }
        if(Session::get('restaurant')){
            $restaurantid=Session::get('restaurant');
            $restaurant=Restaurant::find($restaurantid);
            return view('profilepage',['restaurant'=>$restaurant]);
        }
        if(Session::get('admin')){
            $adminid=Session::get('admin');
            $admin=Admin::find($adminid);
            return view('profilepage',['admin'=>$admin]);
        }
    }
    function createresto(Request $req){
        $req->validate([
            'name'=>'required|max:50',
            'location'=>'required|max:50',
            'email'=>'email|required|unique:users,email',
            'password'=>'required',
        ],
    ['location.required'=>"You must input your location.",
    'password.required'=>"You must input a password.",
    'name.max'=>"Username is too long. Please use a shorter username",
    'email.required'=>"Please enter an email.",
    'email.unique'=>"Email has already been registered in database.",
    'name.required'=>"Please enter a name."
  ]);
    $resto=new Restaurant;
    $resto->restaurantEmail=$req->email;
    $resto->restaurantName=$req->name;
    $resto->location=$req->location;
    $resto->password=$req->password;
    $resto->balance=0;
    $resto->save();
    return redirect('/login');
    }
    function createadmin(Request $req){
        $req->validate([
            'name'=>'required|max:50',
            'email'=>'email|required|unique:users,email',
            'password'=>'required',
        ],
    [
    'password.required'=>"You must input a password.",
    'name.max'=>"Username is too long. Please use a shorter username",
    'email.required'=>"Please enter an email.",
    'email.unique'=>"Email has already been registered in database.",
    'name.required'=>"Please enter a name."
    ]);
        $admin=new admin;
        $admin->email=$req->email;
        $admin->username=$req->name;
        $admin->password=$req->password;
        $admin->save();
    }
}
