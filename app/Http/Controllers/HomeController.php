<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Restaurant;
use App\Models\member;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\Ad;

class HomeController extends Controller
{
    function fullviewrecipe(Request $req){
        $collection=Recipe::paginate(3);
        $membershipstatus=0;
        if(Session::get('user')){
        $member=member::where('memberId','=',Session::get('user')->id)->where('membershipDueDate','>=',Carbon::now()->format('Y-m-d'))->first();
        if($member==null){
            $membershipstatus=0;
        }
        else{
            $membershipstatus=1;
        }}
        if(Session::get('admin')){
            $membershipstatus=1;
        }
        return view('homepage',['collection'=> $collection,'membership'=>$membershipstatus]);
    }
}
