<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }

    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            // Option 1 : return route('login'); (ça provoque l'erreur actuelle)
            // Option 2 : Retourner un message JSON clair
            abort(response()->json([
                'message' => 'Non authentifié. Veuillez vous connecter.'
            ], 401));
        }
    }

}
