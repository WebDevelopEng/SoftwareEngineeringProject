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
                'image'=>'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'category'=>'required'
            ]
            );
        $currentrestaurant=session('restaurant')->id;
        $recipe= new Recipe;
        $recipe->Name=$req->name;
        $recipe->premium=$req->premium;
        $recipe->category=$req->category;
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
        $collection=Recipe::where('category','like',"%".$req->search."%")->orWhere('name','like','%'.$req->search.'%')->paginate(20); 
        $membershipstatus=0;
        if(Session::get('user')){
        $member=member::where('memberId','=',Session::get('user')->id)->where('membershipDueDate','>=',Carbon::now()->format('Y-m-d'));
        if($member==null){
            $membershipstatus=0;
        }
        else{
            $membershipstatus=1;
        }}
        if(Session::get('admin')){
            $membershipstatus=1;
        }
        return view('menudashboard',['collection'=> $collection,'membership'=>$membershipstatus,'state'=>1]);
    }
    function updaterecipe(Request $req,$id){
        $req->validate(
            [
                'name'=>'required|max:255',
                'description'=>'required',
                'ingredients'=>'required',
                'premium'=>'required',
                'image'=>'required|image|mimes:jpeg,png,jpg,svg|max:2048'
            ]
            );
        $currentrestaurant=session('restaurant')->id;
        $recipe=Recipe::find($id);
        $recipe->Name=$req->name;
        $recipe->premium=$req->premium;
        $recipe->Ingredients=$req->ingredients;
        $recipe->Description=$req->description;
         Storage::disk('public')->delete('/recipeimages/'.$recipe->image);
        if($req->image!=null){
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('YmdHis');
            $stringformat=$currentrestaurant.$currenttime.'.'.$extension;
            $req->image->storeAs('/recipeimages',$stringformat,'public');
            $recipe->image=$stringformat;
        }
        $recipe->save();
        return redirect(route('viewrecipe',['recipeid' => $recipe->RecipeID ]));
    }
    function fullviewrecipe(Request $req){
        $collection=Recipe::paginate(20);
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
        return view('menudashboard',['collection'=> $collection,'membership'=>$membershipstatus]);
    }
    function viewparticularrecipe(Request $req,$recipeid){
        $recipe=Recipe::find($recipeid);
        $restaurant=$recipe->restaurant_id;
        $receivingrestaurant=Restaurant::find($restaurant);
        $ad=Ad::inRandomOrder()->first();
        
        if(Session::get('restaurant')!=null){
            if(Session::get('restaurant')->id==$restaurant){
                 return view('menupage',['recipe'=>$recipe , 'restaurant'=>$receivingrestaurant ,'ad' => $ad]);
            }
        }
        if(Session::get('user')!=null){
        $collection2=member::where('memberId','=',Session::get('user')->id)->where('membershipDueDate','>=',Carbon::now()->format('Y-m-d'))->first();
        if($collection2!=null){
            $receivingrestaurant->balance=$receivingrestaurant->balance+50;
            if($recipe->premium=True){
                $receivingrestaurant->balance=$receivingrestaurant->balance+70;
            }
            $receivingrestaurant->save();
            return view('menupage',['recipe'=>$recipe,'restaurant'=>$receivingrestaurant,'ad'=>null]);
        }
        }
        if(Session::get('admin')!=null){
            return view('menupage',['recipe'=>$recipe,'restaurant'=>$receivingrestaurant,'ad'=>null]);
        }
        $receivingrestaurant->balance=$receivingrestaurant->balance+50;
        $receivingrestaurant->save();   // ini untuk pendapatan ads dari suatu akses sebuah resep.
        return view('menupage',['recipe'=>$recipe ,'restaurant'=>$receivingrestaurant ,'ad'=>$ad]);
    }
    function recipeeditpage(Request $req, $recipeid){
        $currentrecipe=Recipe::find($recipeid);
        return view('editrecipe',['recipe'=>$currentrecipe]);
    }
    function recipedelete(Request $req, $recipeid){
        $currentrecipe=Recipe::find($recipeid);
        if($currentrecipe->image!=null){
        Storage::disk('public')->delete('/recipeimages/'.$currentrecipe->image);}
        $currentrecipe->delete();
        if(Session::get('admin')!=null){
        return redirect('admrecipes');
        }
        else{
            return redirect(route('allmyrecipes'));
        }
    }
    function allmyrecipes(Request $req){
        $restaurantid=Session::get('restaurant')->id;
        $allrecipes=Recipe::where('restaurant_id','=',$restaurantid)->paginate(20);
        return view('myrecipes',['collection'=> $allrecipes]);
    }
    function admrecipes(Request $req){
        $allrecipes=Recipe::paginate(20);
        return view('admrecipes',['recipes'=>$allrecipes]);
    }
}
