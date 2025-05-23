<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
class EditRecipe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $req, Closure $next): Response
    {
        if($req->restaurant_id!=null){
        if($req->restaurant_id == Session::get('restaurant')->id || null !== Session::get('admin')){ 
        return $next($req);
        }
        else{
            return abort('403');
        }
    }
}
}