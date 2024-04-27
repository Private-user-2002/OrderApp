<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if(!$request->expectsJson()){
            if(auth()->guard('admin')->check() || request()->routeIs('admin.*')) {
                return route('admin.login');
            } elseif(request()->routeIs('login')) {
                return route('admin.login');
            }

        }
    }
}