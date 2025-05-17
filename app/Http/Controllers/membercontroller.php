<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\member;
use Carbon;
use App\Http\Models\User;

class membercontroller extends Controller
{
    //
    function subscribe(Request $req){
        $req->validate([
            'days'=>'required',
            'months'=>'required',
            'years'=>'required'
        ]);
        
        $user=User::find(session('account'));
        $totalaccount=300 * $req->years + 28*req->months + $req->days; 
        if($user->balance >=$totalaccount ){
        $currenttime=Carbon::now();
        $currenttime=$currenttime.addYears($req->years);
        $currenttime=$currenttime.addMonths($req->months);
        $currenttime=$currenttime.addDays($req->days);
        $member= new member;
        $currenttime=$currenttime->format('Y-m-d H:i:s');
        $member->membershipDueDate=$currenttime;
        $member->memberId=session('account');
        $member->activeStatus=1;
        $member->save();
        }
        else{
            return view('/subscription',['error1','Insufficient balance']);
        }
    }
}
