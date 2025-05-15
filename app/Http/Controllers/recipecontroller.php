<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
class recipecontroller extends Controller
{
    //
    function createrecipe(Request $req){
        $req->validate(
            [
                'name'=>'required|max:255',
                'description'=>'required|string',
                'ingredients'=>'required|string',
                'image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048'
            ]
            );
        $currentrestaurant=session('restaurant')->id;
        $recipe= new Recipe;
        $recipe->Name=$req->name;
        $recipe->Ingredients=$req->ingredients;
        $recipe->Description=$req->description;
        $recipe->restaurant_id=$currentrestaurant;
        if($req->image!=null){
            $extension=$req->image->getClientOriginalExtension();
            $currenttime=now()->format('Ymd');
            $stringformat=$currentrestaurant.$currenttime.'.'.$extension;
            $req->image->storeAs('/recipeimages',$stringformat,'public');
            $recipe->image=$stringformat;
        }
        $recipe->save();
        return redirect('/recipes');
    }
    function searchrecipe(Request $req){
        $collection=Recipe::where('name','like',"%".$req->query."%")->paginate(20); 
        return redirect('/recipe',['collection'=> $collection]);
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
        return view('menudashboard',['collection'=> $collection]);
    }
    function viewparticularrecipe(Request $req,$recipeid){
        $recipe=Recipe::find($recipeid);
        return redirect('/recipe/'.$recipeid,['recipe'=>$recipe]);
    }
}
