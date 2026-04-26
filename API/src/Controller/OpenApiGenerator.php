<?php
/**
 * SAE401 OpenAPI (Swagger) Generator
 * Provides OpenAPI 3 specification JSON for the API endpoints.
 * @author SAE401 Team
 * @version 1.0.0
 */

namespace Controller;

class OpenApiGenerator
{
    /**
     * Generate OpenAPI specification object
     * @return array
     */
    public static function generate(): array
    {
        $resources = [
            'brands' => ['brand_name' => 'string'],
            'categories' => ['category_name' => 'string'],
            'products' => [
                'product_name' => 'string',
                'brand_id' => 'integer',
                'brand_name' => 'string',
                'category_id' => 'integer',
                'category_name' => 'string',
                'model_year' => 'integer',
                'list_price' => 'number'
            ],
            'stores' => [
                'store_name' => 'string',
                'phone' => 'string',
                'email' => 'string',
                'street' => 'string',
                'city' => 'string',
                'state' => 'string',
                'zip_code' => 'string'
            ],
            'employees' => [
                'store_id' => 'integer',
                'employee_name' => 'string',
                'employee_email' => 'string',
                'employee_password' => 'string',
                'employee_role' => 'string'
            ],
            'stocks' => [
                'product_id' => 'integer',
                'store_id' => 'integer',
                'quantity' => 'integer'
            ]
        ];

        $paths = [];

        // Add login endpoint
        $paths['/bikestores/login'] = [
            'post' => [
                'summary' => 'Authenticate employee login',
                'requestBody' => [
                    'required' => true,
                    'content' => [
                        'application/json' => [
                            'schema' => ['$ref' => '#/components/schemas/LoginRequest']
                        ]
                    ]
                ],
                'responses' => [
                    '200' => ['description' => 'Login successful', 'content' => ['application/json' => ['schema' => ['$ref' => '#/components/schemas/LoginResponse']]]],
                    '400' => ['description' => 'Bad request', 'content' => ['application/json' => ['schema' => ['$ref' => '#/components/schemas/Error']]]],
                    '401' => ['description' => 'Invalid credentials', 'content' => ['application/json' => ['schema' => ['$ref' => '#/components/schemas/Error']]]]
                ]
            ]
        ];
        foreach ($resources as $resource => $fields) {
            $getOperation = [
                'summary' => "List all $resource",
                'responses' => [
                    '200' => ['description' => 'OK', 'content' => ['application/json' => ['schema' => ['type' => 'array', 'items' => ['$ref' => '#/components/schemas/' . ucfirst($resource)]]]]] 
                ]
            ];

            // Add query parameters for products
            if ($resource === 'products') {
                $getOperation['parameters'] = [
                    ['name' => 'brand_id', 'in' => 'query', 'schema' => ['type' => 'integer'], 'description' => 'Filter by brand ID'],
                    ['name' => 'category_id', 'in' => 'query', 'schema' => ['type' => 'integer'], 'description' => 'Filter by category ID'],
                    ['name' => 'model_year', 'in' => 'query', 'schema' => ['type' => 'integer'], 'description' => 'Filter by model year'],
                    ['name' => 'min_price', 'in' => 'query', 'schema' => ['type' => 'number'], 'description' => 'Minimum list price'],
                    ['name' => 'max_price', 'in' => 'query', 'schema' => ['type' => 'number'], 'description' => 'Maximum list price']
                ];
            }

            $paths['/bikestores/' . $resource] = [
                'get' => $getOperation,
                'post' => [
                    'summary' => "Create a new $resource",
                    'security' => [['ApiKeyAuth' => []]],
                    'requestBody' => [
                        'required' => true,
                        'content' => ['application/json' => ['schema' => ['$ref' => '#/components/schemas/' . ucfirst($resource)]]]
                    ],
                    'responses' => ['201' => ['description' => 'Created']]
                ]
            ];

            $paths['/bikestores/' . $resource . '/{id}'] = [
                'parameters' => [[
                    'name' => 'id',
                    'in' => 'path',
                    'required' => true,
                    'schema' => ['type' => 'integer']
                ]],
                'get' => [
                    'summary' => "Get a $resource item by ID",
                    'responses' => ['200' => ['description' => 'OK']]
                ],
                'put' => [
                    'summary' => "Update $resource by ID",
                    'security' => [['ApiKeyAuth' => []]],
                    'requestBody' => [
                        'required' => true,
                        'content' => ['application/json' => ['schema' => ['$ref' => '#/components/schemas/' . ucfirst($resource)]]]
                    ],
                    'responses' => ['200' => ['description' => 'OK']]
                ],
                'delete' => [
                    'summary' => "Delete $resource by ID",
                    'security' => [['ApiKeyAuth' => []]],
                    'responses' => ['204' => ['description' => 'No Content']]
                ]
            ];
        }

        $schemas = [];

        // Add login schemas
        $schemas['LoginRequest'] = [
            'type' => 'object',
            'required' => ['employee_email', 'employee_password'],
            'properties' => [
                'employee_email' => ['type' => 'string', 'format' => 'email', 'example' => 'employee@example.com'],
                'employee_password' => ['type' => 'string', 'example' => 'password123', 'minLength' => 1]
            ]
        ];

        $schemas['LoginResponse'] = [
            'type' => 'object',
            'properties' => [
                'message' => ['type' => 'string', 'example' => 'Login successful'],
                'employee' => ['$ref' => '#/components/schemas/EmployeeSummary']
            ]
        ];

        $schemas['EmployeeSummary'] = [
            'type' => 'object',
            'properties' => [
                'employee_id' => ['type' => 'integer', 'example' => 1],
                'employee_name' => ['type' => 'string', 'example' => 'John Doe'],
                'employee_email' => ['type' => 'string', 'format' => 'email', 'example' => 'john.doe@example.com'],
                'employee_role' => ['type' => 'string', 'example' => 'Manager'],
                'store_id' => ['type' => 'integer', 'example' => 1],
                'store_name' => ['type' => 'string', 'example' => 'Main Store']
            ]
        ];

        $schemas['Error'] = [
            'type' => 'object',
            'properties' => [
                'success' => ['type' => 'boolean', 'example' => false],
                'error' => ['type' => 'string', 'example' => 'Error message'],
                'status_code' => ['type' => 'integer', 'example' => 400]
            ]
        ];
        foreach ($resources as $resource => $properties) {
            $schemaFields = [];
            foreach ($properties as $name => $type) {
                $schemaFields[$name] = ['type' => $type];
            }
            $schemas[ucfirst($resource)] = [
                'type' => 'object',
                'properties' => $schemaFields
            ];
        }

        return [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'SAE401 Inventory API',
                'version' => '1.0.0',
                'description' => 'OpenAPI documentation for the SAE401 RESTful API'
            ],
            'servers' => [[
                'url' => '/API/public',
                'description' => 'Local API server'
            ]],
            'components' => [
                'securitySchemes' => [
                    'ApiKeyAuth' => [
                        'type' => 'apiKey',
                        'in' => 'header',
                        'name' => 'X-API-Key'
                    ]
                ],
                'schemas' => $schemas
            ],
            'paths' => $paths
        ];
    }
}

?>