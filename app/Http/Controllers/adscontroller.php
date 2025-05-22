<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adscontroller extends Controller
{
    //
    function createads(){
        $req->validate([
            'url' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        $ad=new Ad;
        $ad->url=$req->url;
        $ad->description=$req->description;
        if($req->image!=null){
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('Ymd');
            $stringformat=$currentrestaurant.$currenttime.'.'.$extension;
            $req->image->storeAs('/adsimages',$stringformat,'public');
            $recipe->image=$stringformat;
        }
        $ad->save();
        return redirect('/ads');
    }
    function readads(){
        $ads=Ad::all();
        return view('ads', ['ads'=>$ads]);
    }
    function queueads(){
        $ads=Ad::where('status', 'queued')->get();
        return view('ads', ['ads'=>$ads]);
    }
    function modifyads(){
        $req->validate([
            'id'=>'required',
            'url'=>'required',
            'description'=>'required'
        ]);
        $ad=Ad::find($req->id);
        if($ad){
            $ad->url=$req->url;
            $ad->description=$req->description;
            $ad->save();
        }
        else{
            return redirect('/ads',['error1','Ad not found']);
        }
    }
    function approveads(){
        $req->validate([
            'id'=>'required'
        ]);
        $ad=Ad::find($req->id);
        if($ad){
            $ad->status='approved';
            $ad->save();
        }
        else{
            return redirect('/ads',['error1','Ad not found']);
        }
    }
    function displayads(){
        $ads=Ad::where('status', 'approved')->get();
    }

}
