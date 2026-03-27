<?php
/**
 * SAE401 API Entry Point
 * Main entry point for the REST API following MVC architecture
 * @author SAE401 Team
 * @version 1.0.0
 */

// Include bootstrap to initialize Doctrine
require_once __DIR__ . '/../bootstrap.php';

// Set content type
header('Content-Type: application/json; charset=utf-8');

// Include autoloader for our custom classes
require_once __DIR__ . '/../vendor/autoload.php';

// Get HTTP method and URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];

// Create router and handle request
use Controller\Router;

$router = new Router($entityManager);
$response = $router->route($method, $uri, $scriptName);

// Set HTTP status code
if (isset($response['status_code'])) {
    http_response_code($response['status_code']);
}

// Remove status_code from response before sending JSON
unset($response['status_code']);

// Output JSON response
echo json_encode($response);

?>