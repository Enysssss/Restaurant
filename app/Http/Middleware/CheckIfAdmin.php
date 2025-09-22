<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userConnected = Auth::User();
        $user = User::find($userConnected->id);


        if ($user->can('Create Dish')) {
            return $next($request);
        } else {
            return redirect()->route('dashboard')->withErrors(['error_create_dish' => 'PROUBLEME, Not authorise to create dish']);
        }

    }
}

