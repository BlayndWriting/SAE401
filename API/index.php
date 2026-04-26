<?php

/**
 * API front controller.
 *
 * Initializes dependencies, registers routes and dispatches the incoming request.
 */

require_once __DIR__ . '/bootstrap.php';

use SAE401\BikestoresApi\Utils\Router;
use SAE401\BikestoresApi\Controller\AuthController;
use SAE401\BikestoresApi\Controller\BrandController;
use SAE401\BikestoresApi\Controller\ProductController;
use SAE401\BikestoresApi\Controller\CategoryController;
use SAE401\BikestoresApi\Controller\StoreController;
use SAE401\BikestoresApi\Controller\StockController;
use SAE401\BikestoresApi\Controller\EmployeeController;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-API-KEY, Authorization');

if (strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(204);
    exit;
}

/**
 * Central router used to map endpoints to controller actions.
 *
 * @var Router
 */
$router = new Router();

/** @var AuthController $authController */
$authController = new AuthController($entityManager);
/** @var BrandController $brandController */
$brandController = new BrandController($entityManager);
/** @var ProductController $productController */
$productController = new ProductController($entityManager);
/** @var CategoryController $categoryController */
$categoryController = new CategoryController($entityManager);
/** @var StoreController $storeController */
$storeController = new StoreController($entityManager);
/** @var StockController $stockController */
$stockController = new StockController($entityManager);
/** @var EmployeeController $employeeController */
$employeeController = new EmployeeController($entityManager);

$router->add("POST", "/login", [$authController, "login"]);

$router->add("GET", "/brands", [$brandController, "getAll"]);
$router->add("GET", "/brands/{id}", [$brandController, "getById"]);
$router->add("POST", "/brands", [$brandController, "create"]);
$router->add("PUT", "/brands/{id}", [$brandController, "update"]);
$router->add("DELETE", "/brands/{id}", [$brandController, "delete"]);

$router->add("GET", "/products", [$productController, "getAll"]);
$router->add("GET", "/products/{id}", [$productController, "getById"]);
$router->add("POST", "/products", [$productController, "create"]);
$router->add("PUT", "/products/{id}", [$productController, "update"]);
$router->add("DELETE", "/products/{id}", [$productController, "delete"]);

$router->add("GET", "/categories", [$categoryController, "getAll"]);
$router->add("GET", "/categories/{id}", [$categoryController, "getById"]);
$router->add("POST", "/categories", [$categoryController, "create"]);
$router->add("PUT", "/categories/{id}", [$categoryController, "update"]);
$router->add("DELETE", "/categories/{id}", [$categoryController, "delete"]);

$router->add("GET", "/stores", [$storeController, "getAll"]);
$router->add("GET", "/stores/{id}", [$storeController, "getById"]);
$router->add("POST", "/stores", [$storeController, "create"]);
$router->add("PUT", "/stores/{id}", [$storeController, "update"]);
$router->add("DELETE", "/stores/{id}", [$storeController, "delete"]);

$router->add("GET", "/stocks", [$stockController, "getAll"]);
$router->add("GET", "/stocks/{id}", [$stockController, "getById"]);
$router->add("POST", "/stocks", [$stockController, "create"]);
$router->add("PUT", "/stocks/{id}", [$stockController, "update"]);
$router->add("DELETE", "/stocks/{id}", [$stockController, "delete"]);

$router->add("GET", "/employees", [$employeeController, "getAll"]);
$router->add("GET", "/employees/{id}", [$employeeController, "getById"]);
$router->add("POST", "/employees", [$employeeController, "create"]);
$router->add("PUT", "/employees/{id}", [$employeeController, "update"]);
$router->add("DELETE", "/employees/{id}", [$employeeController, "delete"]);

$router->run();