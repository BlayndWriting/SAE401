# SAE401 API Documentation

## Overview
The SAE401 Inventory Management API is a RESTful web service that provides CRUD operations for managing inventory data. The API follows MVC architecture and requires authentication for write operations.

## Architecture
- **Model**: Doctrine ORM entities in `src/Entity/`
- **View**: JSON responses
- **Controller**: API logic in `src/Controller/ApiController.php`
- **Router**: Request routing in `src/Controller/Router.php`

## Authentication
For operations other than GET (POST, PUT, DELETE), you must provide the API key in the request header:

```
X-API-Key: e8f1997c763
```

## Endpoints

### Brands
- `GET /bikestores/brands` - List all brands
- `GET /bikestores/brands/{id}` - Get brand by ID
- `POST /bikestores/brands` - Create new brand (requires API key)
- `PUT /bikestores/brands/{id}` - Update brand (requires API key)
- `DELETE /bikestores/brands/{id}` - Delete brand (requires API key)

### Categories
- `GET /bikestores/categories` - List all categories
- `GET /bikestores/categories/{id}` - Get category by ID
- `POST /bikestores/categories` - Create new category (requires API key)
- `PUT /bikestores/categories/{id}` - Update category (requires API key)
- `DELETE /bikestores/categories/{id}` - Delete category (requires API key)

### Products
- `GET /bikestores/products` - List all products
- `GET /bikestores/products/{id}` - Get product by ID
- `POST /bikestores/products` - Create new product (requires API key)
- `PUT /bikestores/products/{id}` - Update product (requires API key)
- `DELETE /bikestores/products/{id}` - Delete product (requires API key)

### Stores
- `GET /bikestores/stores` - List all stores
- `GET /bikestores/stores/{id}` - Get store by ID
- `POST /bikestores/stores` - Create new store (requires API key)
- `PUT /bikestores/stores/{id}` - Update store (requires API key)
- `DELETE /bikestores/stores/{id}` - Delete store (requires API key)

### Employees
- `GET /bikestores/employees` - List all employees
- `GET /bikestores/employees/{id}` - Get employee by ID
- `POST /bikestores/employees` - Create new employee (requires API key)
- `PUT /bikestores/employees/{id}` - Update employee (requires API key)
- `DELETE /bikestores/employees/{id}` - Delete employee (requires API key)

### Stock
- `GET /bikestores/stocks` - List all stock entries
- `GET /bikestores/stocks/{id}` - Get stock entry by ID
- `POST /bikestores/stocks` - Create new stock entry (requires API key)
- `PUT /bikestores/stocks/{id}` - Update stock entry (requires API key)
- `DELETE /bikestores/stocks/{id}` - Delete stock entry (requires API key)

## Request/Response Format

### Successful Response
```json
{
  "success": true,
  "data": { ... }
}
```

### Error Response
```json
{
  "success": false,
  "error": "Error message"
}
```

### Create/Update Request Body
```json
{
  "field_name": "value",
  "another_field": "another_value"
}
```

## Example Usage

### Get all products (no authentication required)
```bash
curl -X GET http://your-api-url/bikestores/products
```

### Create a new product (authentication required)
```bash
curl -X POST http://your-api-url/bikestores/products \
  -H "Content-Type: application/json" \
  -H "X-API-Key: e8f1997c763" \
  -d '{
    "product_name": "New Product",
    "category_id": 1,
    "brand_id": 1,
    "model_year": 2024,
    "list_price": 99.99
  }'
```

### Update a product (authentication required)
```bash
curl -X PUT http://your-api-url/bikestores/products/1 \
  -H "Content-Type: application/json" \
  -H "X-API-Key: e8f1997c763" \
  -d '{
    "product_name": "Updated Product Name",
    "list_price": 149.99
  }'
```

### Delete a product (authentication required)
```bash
curl -X DELETE http://your-api-url/bikestores/products/1 \
  -H "X-API-Key: e8f1997c763"
```

## HTTP Status Codes
- `200` - Success
- `201` - Created
- `204` - No Content (for DELETE)
- `400` - Bad Request
- `401` - Unauthorized (invalid API key)
- `404` - Not Found
- `405` - Method Not Allowed
- `500` - Internal Server Error

## Security Notes
- The API key `e8f1997c763` must be provided in the `X-API-Key` header for all write operations
- GET operations are public and do not require authentication
- All input data is validated and sanitized
- CORS headers are configured for cross-origin requests
