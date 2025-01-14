<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Route;
use Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user_role = Auth::user()->role;

        $current_route_name = Route::currentRouteName();

        $current_route_name_exploded = explode( ".", $current_route_name );

        $current_route_name_prefix = $current_route_name_exploded[ 0 ];

        if ( $user_role == 'admin' ) {
            if ( $current_route_name_prefix == "landlord" || $current_route_name_prefix == "tenant" || $current_route_name_prefix == "technision" ) {
                return redirect()->route( "admin.dashboard" );
            }

        } else if ( $user_role == 'landlord' ) {
            if ( $current_route_name_prefix == "admin" || $current_route_name_prefix == "tenant" || $current_route_name_prefix == "technision") {
                return redirect()->route( "landlord.dashboard" );
            }

        } else if ( $user_role == 'tenant' ) {
            if ( $current_route_name_prefix == "admin" || $current_route_name_prefix == "landlord" || $current_route_name_prefix == "technision" ) {
                return redirect()->route( "tenant.dashboard" );
            }
        }else if( $user_role == 'technision'){

            if ( $current_route_name_prefix == "admin" || $current_route_name_prefix == "landlord"  || $current_route_name_prefix == "tenant" ) {
                return redirect()->route( "technision.dashboard" );
            }
        }
        return $next($request);
    }
}
