<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class acccontroller extends Controller
{
    //
    function create_account(Request $req){
        $req->validate([
            'name'=>'required|max:50',
            'dob'=>['required','before:today','date'],
            'email'=>'email|required',
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
    $currentuser=User::where('email',$req->email)->where('password',$req->password)->first();
    if ($currentuser == null){
        return redirect('/login');
    }
    else{
        session(['account'=>$currentuser->id]);
        return redirect('/menu');
    }
    }
    function updateaccount(){
        if(session('account')!=null){
            $account=User::find(session('account'));
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
}
