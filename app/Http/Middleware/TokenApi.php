<?php namespace App\Http\Middleware;

use App\Entities\Configs\User;
use Closure;

class TokenApi{

    public function handle($request, Closure $next){
       
        $token = $request->token;
       
        if (!$token) {
            return response('Unauthorized.', 401);
            // No se proporcionó un token
            // Maneja la lógica correspondiente
        }
    
        $user = User::where('remember_token', $token)->first();
    
        if (!$user) {
            return response('Unauthorized.', 401);
            // El token no es válido
            // Maneja la lógica correspondiente
        }

        return $next($request);

    }

}