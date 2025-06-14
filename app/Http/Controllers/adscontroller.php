<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;
use Illuminate\Support\Facades\Storage;
class adscontroller extends Controller
{
    //
    function createads(Request $req){
        $req->validate([
            'title' => 'required',
            'description' => 'required|max:50',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        
        $ad=new Ad;
        $ad->title=$req->title;
        $ad->description=$req->description;
        if($req->image!=null){
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat="adm".$currenttime.'.'.$extension;
            $req->image->storeAs('advertimages',$stringformat,'public');
            $ad->image=$stringformat;
        }
        $ad->save();
        return redirect('/ads');
    }
    function readads(){
        $ads=Ad::all();
        return view('ads', ['ads'=>$ads]);
    }
    function editad(Request $req, $adid){
        $req->validate([
            'title'=>'required',
            'description'=>'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);
        $ad=Ad::find($adid);
        if($req->image!=null){
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat="adm".$currenttime.'.'.$extension;
            $req->image->storeAs('advertimages',$stringformat,'public');
            $ad->image=$stringformat;
        }
            $ad->title=$req->title;
            $ad->description=$req->description;
            $ad->save();
            return redirect('/ads');
    }
    function displayads(){
        $ads=Ad::where('status', 'approved')->get();
    }
    function addashboard(){
        $ads=Ad::paginate(5);
        return view('addashboard',['ads' => $ads]);
    }
    function editadview(Request $req,$adid){
        $ads=Ad::find($adid);
        return view('editad',['ad'=>$ads]);
    }
    function deletead(Request $req, $adid){
        $ad=Ad::find($adid);
       if($ad->image!=null){
        Storage::disk('public')->delete('/advertimages/'.$ad->image);}
        $ad->delete();
        return redirect(route('addashboard'));
    }
}
