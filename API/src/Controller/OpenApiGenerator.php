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
                'category_id' => 'integer',
                'brand_id' => 'integer',
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
        foreach ($resources as $resource => $fields) {
            $paths['/bikestores/' . $resource] = [
                'get' => [
                    'summary' => "List all $resource",
                    'responses' => [
                        '200' => ['description' => 'OK', 'content' => ['application/json' => ['schema' => ['type' => 'array', 'items' => ['$ref' => '#/components/schemas/' . ucfirst($resource)]]]]] 
                    ]
                ],
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