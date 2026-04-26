<?php
/**
 * SAE401 API Router
 * Routes API requests to appropriate controllers
 * @author SAE401 Team
 * @version 1.0.0
 */

namespace Controller;

use Doctrine\ORM\EntityManager;
use Controller\OpenApiGenerator;

class Router
{
    private EntityManager $entityManager;
    private ApiController $apiController;

    /**
     * Constructor
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->apiController = new ApiController($entityManager);
    }

    /**
     * Route the request
     * @param string $method HTTP method
     * @param string $uri Request URI
     * @param string $scriptName Script name
     * @return array Response data
     */
    public function route(string $method, string $uri, string $scriptName): array
    {
        // Parse the URI
        $path = '/' . trim(substr($uri, strlen(dirname($scriptName))), '/');
        $segments = array_values(array_filter(explode('/', $path)));

        // Check if it's an API request (bikestores root)
        if (count($segments) < 2 || !in_array($segments[0], ['bikestores', 'api'])) {
            return [
                'success' => false,
                'error' => 'API endpoint not found',
                'status_code' => 404
            ];
        }

        // Normalize old /api/ path to /bikestores/ internally
        if ($segments[0] === 'api') {
            $segments[0] = 'bikestores';
        }

        $resource = $segments[1];
        $id = isset($segments[2]) ? intval($segments[2]) : null;

        // Handle login endpoint
        if ($resource === 'login' && $method === 'POST') {
            return $this->apiController->handleLogin();
        }

        // Get API key from header for write operations
        $apiKey = null;
        if ($method !== 'GET') {
            $headers = getallheaders();
            $apiKey = $headers['X-API-Key'] ?? $headers['x-api-key'] ?? null;
        }

        // Read JSON body for POST/PUT/PATCH
        $data = [];
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $body = file_get_contents('php://input');
            $data = json_decode($body, true) ?? [];
        }

        // OpenAPI documentation route (Swagger JSON)
        if ($resource === 'openapi' || $resource === 'openapi.json') {
            $openApi = OpenApiGenerator::generate();
            return array_merge(['status_code' => 200], $openApi);
        }

        // Route to controller
        return $this->apiController->handleRequest($method, $resource, $id, $data, $apiKey);
    }
}
?>