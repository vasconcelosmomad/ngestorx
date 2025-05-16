<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {    
            return redirect()->route('logout')->with('message', 'Sessão expirada. Por favor, faça login novamente.');
        }
    }
    

    
}
