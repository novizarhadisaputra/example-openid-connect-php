<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Unleash\Client\UnleashBuilder;
use Symfony\Component\HttpFoundation\Response;
use Unleash\Client\Configuration\UnleashContext;

class UnleashMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $feature): Response
    {
        if (!$feature) {
            throw new Exception('feature is required');
        }

        $unleash = UnleashBuilder::create()
            ->withAppName('Laravel Token')
            ->withAppUrl('http://localhost:4242/api')
            ->withInstanceId('Some instance id')
            ->build();

        $context = (new UnleashContext())
            ->setCurrentUserId(Str::uuid())
            ->setIpAddress('127.0.0.1')
            ->setSessionId('sess-123456');

        if ($unleash->isEnabled($feature, $context)) {
            throw new Exception('');
        }

        return $next($request);
    }
}
