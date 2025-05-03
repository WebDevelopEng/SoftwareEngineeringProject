<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Recipe;
class recipecontroller extends Controller
{
    //
    function createrecipe(Request $req){
        $req->validate(
            [
                'name'=>'required|max:255',
                'description'=>'required|min:20',
                'ingredients'=>'required|min:20'
            ]
            );
        $currentrestaurant=session('restaurant');
        $recipe= new Recipe;
        $recipe->Name=$req->name;
        $recipe->Ingredients=$req->ingredients;
        $recipe->Description=$req->description;
        $recipe->restaurant_id=$currentrestaurant;
        $recipe->save();

    }
    function searchrecipe(Request $req){
        
    }
}
