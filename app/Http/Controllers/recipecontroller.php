<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Restaurant;
use App\Models\member;
use Illuminate\Support\Facades\Session;
class recipecontroller extends Controller
{
    //
    function createrecipe(Request $req){
        $req->validate(
            [
                'name'=>'required|max:255',
                'description'=>'required|string',
                'ingredients'=>'required|string',
                'premium'=>'required',
                'image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]
            );
        $currentrestaurant=session('restaurant')->id;
        $recipe= new Recipe;
        $recipe->Name=$req->name;
        $recipe->premium=$req->premium;
        $recipe->Ingredients=$req->ingredients;
        $recipe->Description=$req->description;
        $recipe->restaurant_id=$currentrestaurant;
        if($req->image!=null){
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat=$currentrestaurant.$currenttime.'.'.$extension;
            $req->image->storeAs('/recipeimages',$stringformat,'public');
            $recipe->image=$stringformat;
        }
        $recipe->save();
        return redirect('/menudashboard');
    }
    function searchrecipe(Request $req){
        $collection=Recipe::where('name','like',"%".$req->search."%")->paginate(20); 
        $membershipstatus=0;
        if(Session::get('user')){
        $member=member::where('memberId','=',Session::get('user')->id)->where('membershipDueDate','>=',Carbon::now()->format('Y-m-d'));
        if($member==null){
            $membershipstatus=0;
        }
        else{
            $membershipstatus=1;
        }}
        return view('menudashboard',['collection'=> $collection,'membership'=>$membershipstatus,'state'=>1]);
    }
    function updaterecipe(Request $req, $recipeid){
        $req->validate(
            [
                'name'=>'required|max:255',
                'description'=>'required|min:20',
                'ingredients'=>'required|min:20'
            ]
            );
        $currentrecipe=Recipe::find($recipeid);
        $currentrecipe->Name=$req->name;
        $currentrecipe->Ingredients=$req->ingredients;
        $currentrecipe->Description=$req->description;
        $currentrecipe->save();
        return redirect('/recipe'.$recipeid);
    }
    function fullviewrecipe(Request $req){
        $collection=Recipe::paginate(20);
        $membershipstatus=0;
        if(Session::get('user')){
        $member=member::where('memberId','=',Session::get('user')->id)->where('membershipDueDate','>=',Carbon::now()->format('Y-m-d'));
        if($member==null){
            $membershipstatus=0;
        }
        else{
            $membershipstatus=1;
        }}
        
        return view('menudashboard',['collection'=> $collection,'membership'=>$membershipstatus]);
    }
    function viewparticularrecipe(Request $req,$recipeid){
        $recipe=Recipe::find($recipeid);
        $restaurant=$recipe->restaurant_id;
        $receivingrestaurant=Restaurant::find($restaurant);
        if(Session::get('restaurant')!=null){
            if(Session::get('restaurant')->id==$restaurant){
                 return view('menupage',['recipe'=>$recipe , 'restaurant'=>$receivingrestaurant]);
            }
        }
        $receivingrestaurant->balance=$receivingrestaurant->balance+50;
        $receivingrestaurant->save();   // ini untuk pendapatan ads dari suatu akses sebuah resep.
        return view('menupage',['recipe'=>$recipe , 'recipeid'=>$recipeid]);
    }
    
}
