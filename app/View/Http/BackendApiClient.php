<?php

declare(strict_types=1);

namespace App\View\Http;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response as ClientResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class BackendApiClient
{
    public const RESPONSE_COOKIE_HEADER = 'X-Backend-Set-Cookie';

    public function __construct(
        private readonly Factory $http,
    ) {
    }

    public function get(Request $request, string $routeName, array $parameters = []): ClientResponse
    {
        return $this->pendingRequest($request)
            ->get($this->urlFor($routeName, $parameters));
    }

    public function post(
        Request $request,
        string $routeName,
        array $payload = [],
        array $parameters = [],
        bool $asForm = false,
    ): ClientResponse {
        $pendingRequest = $this->pendingRequest($request);

        if ($asForm) {
            $pendingRequest = $pendingRequest->asForm();
        }

        return $pendingRequest->post(
            $this->urlFor($routeName, $parameters),
            $payload,
        );
    }

    public function storeResponseCookies(Response $redirectResponse, ClientResponse $response): void
    {
        foreach ($response->toPsrResponse()->getHeader('Set-Cookie') as $cookieHeader) {
            $redirectResponse->headers->set(
                self::RESPONSE_COOKIE_HEADER,
                base64_encode($cookieHeader),
                false,
            );
        }
    }

    public function errorMessage(ClientResponse $response, string $default): string
    {
        $message = $response->json('message');

        if (is_string($message) && $message !== '') {
            return $message;
        }

        $errors = $response->json('errors');

        if (is_array($errors)) {
            foreach ($errors as $errorMessages) {
                if (is_array($errorMessages) && isset($errorMessages[0]) && is_string($errorMessages[0])) {
                    return $errorMessages[0];
                }
            }
        }

        return $default;
    }

    private function pendingRequest(Request $request): PendingRequest
    {
        $headers = [
            'X-Requested-With' => 'XMLHttpRequest',
        ];

        $rawCookieHeader = $request->header('Cookie');

        if (is_string($rawCookieHeader) && $rawCookieHeader !== '') {
            $headers['Cookie'] = $rawCookieHeader;
        }

        return $this->http
            ->acceptJson()
            ->withHeaders($headers)
            ->timeout(5);
    }

    private function urlFor(string $routeName, array $parameters = []): string
    {
        return $this->backendBaseUrl()
            .route($routeName, $parameters, absolute: false);
    }

    private function backendBaseUrl(): string
    {
        return rtrim((string) config('services.backend.url', config('app.url')), '/');
    }
}
