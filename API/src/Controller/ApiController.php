<?php
/**
 * SAE401 API Controller
 * Handles all API operations with MVC architecture
 * @author SAE401 Team
 * @version 1.0.0
 */

namespace Controller;

use Doctrine\ORM\EntityManager;
use Exception;

class ApiController
{
    private EntityManager $entityManager;
    private array $resources;
    private string $apiKey = 'e8f1997c763';

    /**
     * Constructor
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->initializeResources();
    }

    /**
     * Initialize available resources configuration
     */
    private function initializeResources(): void
    {
        $this->resources = [
            'brands' => [
                'class' => 'Entity\\Brand',
                'fields' => ['brand_name']
            ],
            'categories' => [
                'class' => 'Entity\\Category',
                'fields' => ['category_name']
            ],
            'products' => [
                'class' => 'Entity\\Product',
                'fields' => ['product_name', 'category_id', 'brand_id', 'model_year', 'list_price']
            ],
            'stores' => [
                'class' => 'Entity\\Store',
                'fields' => ['store_name', 'phone', 'email', 'street', 'city', 'state', 'zip_code']
            ],
            'employees' => [
                'class' => 'Entity\\Employee',
                'fields' => ['store_id', 'employee_name', 'employee_email', 'employee_password', 'employee_role']
            ],
            'stocks' => [
                'class' => 'Entity\\Stock',
                'fields' => ['product_id', 'store_id', 'quantity']
            ],
        ];
    }

    /**
     * Check if API key is valid for write operations
     * @param string|null $providedKey
     * @return bool
     */
    private function validateApiKey(?string $providedKey): bool
    {
        return $providedKey === $this->apiKey;
    }

    /**
     * Handle API request
     * @param string $method HTTP method
     * @param string $resource Resource name
     * @param int|null $id Resource ID
     * @param array $data Request data
     * @param string|null $apiKey API key from header
     * @return array Response data
     */
    public function handleRequest(string $method, string $resource, ?int $id, array $data = [], ?string $apiKey = null): array
    {
        // Check if resource exists
        if (!isset($this->resources[$resource])) {
            return $this->errorResponse('Resource not found', 404);
        }

        $resourceConfig = $this->resources[$resource];

        try {
            switch ($method) {
                case 'GET':
                    return $this->handleGet($resourceConfig, $id);

                case 'POST':
                    if (!$this->validateApiKey($apiKey)) {
                        return $this->errorResponse('Invalid API key', 401);
                    }
                    return $this->handlePost($resourceConfig, $data);

                case 'PUT':
                case 'PATCH':
                    if (!$this->validateApiKey($apiKey)) {
                        return $this->errorResponse('Invalid API key', 401);
                    }
                    if ($id === null) {
                        return $this->errorResponse('Missing ID for update', 400);
                    }
                    return $this->handlePut($resourceConfig, $id, $data);

                case 'DELETE':
                    if (!$this->validateApiKey($apiKey)) {
                        return $this->errorResponse('Invalid API key', 401);
                    }
                    if ($id === null) {
                        return $this->errorResponse('Missing ID for delete', 400);
                    }
                    return $this->handleDelete($resourceConfig, $id);

                default:
                    return $this->errorResponse('Method not allowed', 405);
            }
        } catch (Exception $e) {
            return $this->errorResponse('Server error: ' . $e->getMessage(), 500);
        }
    }

    /**
     * Handle GET requests
     * @param array $resourceConfig
     * @param int|null $id
     * @return array
     */
    private function handleGet(array $resourceConfig, ?int $id): array
    {
        $repo = $this->entityManager->getRepository($resourceConfig['class']);

        if ($id === null) {
            $items = $repo->findAll();
            $data = array_map([$this, 'entityToArray'], $items);
            return $this->successResponse($data);
        }

        $item = $repo->find($id);
        if (!$item) {
            return $this->errorResponse('Not found', 404);
        }

        return $this->successResponse($this->entityToArray($item));
    }

    /**
     * Handle POST requests
     * @param array $resourceConfig
     * @param array $data
     * @return array
     */
    private function handlePost(array $resourceConfig, array $data): array
    {
        $entity = new $resourceConfig['class']();
        $this->createOrUpdateEntity($entity, $resourceConfig['fields'], $data);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this->successResponse($this->entityToArray($entity), 201);
    }

    /**
     * Handle PUT/PATCH requests
     * @param array $resourceConfig
     * @param int $id
     * @param array $data
     * @return array
     */
    private function handlePut(array $resourceConfig, int $id, array $data): array
    {
        $repo = $this->entityManager->getRepository($resourceConfig['class']);
        $item = $repo->find($id);

        if (!$item) {
            return $this->errorResponse('Not found', 404);
        }

        $this->createOrUpdateEntity($item, $resourceConfig['fields'], $data);
        $this->entityManager->flush();

        return $this->successResponse($this->entityToArray($item));
    }

    /**
     * Handle DELETE requests
     * @param array $resourceConfig
     * @param int $id
     * @return array
     */
    private function handleDelete(array $resourceConfig, int $id): array
    {
        $repo = $this->entityManager->getRepository($resourceConfig['class']);
        $item = $repo->find($id);

        if (!$item) {
            return $this->errorResponse('Not found', 404);
        }

        $this->entityManager->remove($item);
        $this->entityManager->flush();

        return $this->successResponse(null, 204);
    }

    /**
     * Convert entity to array
     * @param object $entity
     * @return array
     */
    private function entityToArray(object $entity): array
    {
        $result = [];
        $reflection = new \ReflectionClass($entity);

        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $getter = 'get' . str_replace('_', '', ucwords($name, '_'));

            if ($reflection->hasMethod($getter)) {
                $result[$name] = $entity->{$getter}();
            }
        }

        return $result;
    }

    /**
     * Create or update entity from data
     * @param object $entity
     * @param array $fields
     * @param array $data
     */
    private function createOrUpdateEntity(object $entity, array $fields, array $data): void
    {
        foreach ($fields as $field) {
            if (array_key_exists($field, $data)) {
                $setter = 'set' . str_replace('_', '', ucwords($field, '_'));

                if (method_exists($entity, $setter)) {
                    $entity->{$setter}($data[$field]);
                }
            }
        }
    }

    /**
     * Create success response
     * @param mixed $data
     * @param int $statusCode
     * @return array
     */
    private function successResponse($data, int $statusCode = 200): array
    {
        return [
            'success' => true,
            'data' => $data,
            'status_code' => $statusCode
        ];
    }

    /**
     * Create error response
     * @param string $message
     * @param int $statusCode
     * @return array
     */
    private function errorResponse(string $message, int $statusCode = 400): array
    {
        return [
            'success' => false,
            'error' => $message,
            'status_code' => $statusCode
        ];
    }
}

?>
