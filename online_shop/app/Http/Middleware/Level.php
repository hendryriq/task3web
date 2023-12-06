<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class Level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $levels)
    {
        if (in_array($request->users()->level, $levels)){
            return $next($request);
        }

        if (Auth::user()->level == 'admin'){
            return Redirect::to('dashboard');
        }elseif(Auth::user()->level == 'owner'){
            return Redirect::to('dashboard');
        }elseif(Auth::user()->level == 'operator'){
            return Redirect::to('dashboard');
        }
        elseif(Auth::user()->level == 'pelanggan'){
            return Redirect::to('/');
        }
    }
}
