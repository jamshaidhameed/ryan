<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;
use URL;

class UrlRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session::get('url.intended')){

            $url = Session::get('url.intended');
            Session::forget('url.intended');
            return Redirect::to($url)->with('success','Successfully logged in');
        }
        return $next($request);
    }
}
