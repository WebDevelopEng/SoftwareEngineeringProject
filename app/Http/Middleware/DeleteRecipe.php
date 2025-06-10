<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Models\Recipe;
class DeleteRecipe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if(Session::get('restaurant')){
            $recipeid=$request->route('id');
            $currentrecipe=Recipe::find($recipeid);
            if($currentrecipe->restaurant_id == Session::get('restaurant')->id){
                return $next($request);
            }
            else{
                return abort(403);
            }
        }
        else{
            if(Session::get('admin')){
                return $next($request);
            }
            else{
                return abort(403);
            }
        }
        
    }
}
