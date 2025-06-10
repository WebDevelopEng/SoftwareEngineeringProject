<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\donation;
use Illuminate\Support\Facades\Session;
use App\Models\Recipe;
class ViewEditRecipeandDonations
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $type): Response
    {
    if(Session::get('restaurant')){
    if ($type=='donation')
    {   
        $donationid=$request->route('id');
        $currentdonation=donation::find($donationid);
        if($currentdonation->restaurant_id == Session::get('restaurant')->id){
        return $next($request);
         }
         else{
            return abort(403);
         }
    }
    if($type=='recipe'){
        $recipeid=$request->route('i');
        $currentrecipe=Recipe::find($recipeid);
        if($currentrecipe->restaurant_id==Session::get('restaurant')->id){
            return $next($request);
        }
        else{
            return abort(403);
        }
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
