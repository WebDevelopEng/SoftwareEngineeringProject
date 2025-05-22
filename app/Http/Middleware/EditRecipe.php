<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class EditRecipe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($req->id!=null){
        if($req->restoname == Session::get('restaurant') || null !== Session::get('admin')){ 
        return $next($request);
        }
        else{
            return abort('403');
        }
    }
}
}