<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\View\Http\BackendApiClient;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;

final class PropagateBackendCookies
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $backendCookies = $response->headers->all(BackendApiClient::RESPONSE_COOKIE_HEADER);

        if (! is_array($backendCookies) || $backendCookies === []) {
            return $response;
        }

        foreach ($backendCookies as $encodedCookieHeader) {
            $cookieHeader = is_string($encodedCookieHeader)
                ? base64_decode($encodedCookieHeader, true)
                : false;

            if (is_string($cookieHeader) && $cookieHeader !== '') {
                $response->headers->setCookie(Cookie::fromString($cookieHeader));
            }
        }

        $response->headers->remove(BackendApiClient::RESPONSE_COOKIE_HEADER);

        return $response;
    }
}
