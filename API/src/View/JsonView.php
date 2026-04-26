<?php

namespace SAE401\BikestoresApi\View;

use SAE401\BikestoresApi\Utils\ApiResponse;

/**
 * Renders API responses as JSON.
 */
class JsonView {

    /**
     * Sends the HTTP status, JSON content type and encoded payload.
     *
     * @param ApiResponse $response Response object containing status and body.
     *
     * @return void
     */
    public static function render(ApiResponse $response){

        http_response_code($response->getStatus());

        header('Content-Type: application/json');

        echo json_encode(
            $response->getData(),
            JSON_PRETTY_PRINT
        );
    }

}