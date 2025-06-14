<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\member;
use Carbon\Carbon;
use App\Models\User;

class membercontroller extends Controller
{
    //
    function subscribe(Request $req){
        $req->validate([
            'enddate'=>'required'
        ]);
        
        $user=User::find(session('user')->id);
        $currenttime=Carbon::now();
        $enddate=Carbon::createFromDate($req->enddate);
        $difference=Carbon::createFromDate($req->enddate)->diff($currenttime);
        $price=$difference->y*3000+$difference->m*280+$difference->d*10+$difference->h*1;
        if($user->balance >=$price ){
        $member= new member;
        $currenttime=$currenttime->format('Y-m-d H:i:s');
        $member->membershipDueDate=$enddate->format('Y-m-d H:i:s');
        $member->memberId=session('user')->id;
        $member->membershipStart=$currenttime;
        $member->activeStatus=1;
        $member->price=$price;
        $member->save();
        $user->balance=$user->balance-$price;
        
        $user->save();
        session(['user'=>$user]);
        return redirect(route('profile'));
        }
        else{
            return view('subscription',['error1','Insufficient balance']);
        }
    }
    function refillbalance(Request $req){
        $req->validate([
            'balance'=>'required'
        ]);
        $currentuser=User::find(session('user')->id);
        $currentuser->balance=$req->balance+$currentuser->balance;
        $currentuser->save();
        session(['user'=>$currentuser]);
        return redirect('/profile');
    }
    function subscription(Request $req){
        return view('subscription');
    }
}
