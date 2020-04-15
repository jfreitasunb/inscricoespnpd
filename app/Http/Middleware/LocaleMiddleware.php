<?php

namespace App\Http\Middleware;

use Closure, Auth, Session;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()){
            app()->setLocale(Auth::user()->locale);
        }elseif(Session::has('locale')){
            $locale = Session::get('locale');
            app()->setLocale($locale);
        }else{
            app()->setLocale('pt-br');
        }

        return $next($request);
    }
}
