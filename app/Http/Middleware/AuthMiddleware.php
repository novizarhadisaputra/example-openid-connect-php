<?php

namespace App\Http\Middleware;

use Closure;
use DtoIhc\HisV2AuthMiddleware\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    protected Auth $auth;

    public function __construct()
    {
        $this->auth = new Auth();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $module, $action): Response
    {
        $params = (object) [
            'token'  => $request->cookie('storageToken'), // Replace "CLIENT_TOKEN" with the actual client token value
            'module' => $module,
            'action' => $action,
        ];
        $this->auth->validate($params);

        return $next($request);
    }
}
