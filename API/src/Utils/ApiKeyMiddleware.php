<?php

namespace SAE401\BikestoresApi\Utils;

use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;

/**
 * Validates the API key header for protected endpoints.
 */
class ApiKeyMiddleware
{
    /**
     * Expected API key value.
     */
    private const API_KEY = 'e8f1997c763';

    /**
     * Checks if the request contains a valid API key.
     *
     * @return bool True when authorized, otherwise false.
     */
    public static function check(): bool
    {
        $headers = getallheaders();

        $apiKey = $headers['X-API-KEY'] ?? $headers['x-api-key'] ?? null;

        if ($apiKey !== self::API_KEY) {
            JsonView::render(
                new ApiResponse(401, ["error" => "Unauthorized - Invalid API key"])
            );
            return false;
        }

        return true;
    }
}