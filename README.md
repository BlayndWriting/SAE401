# SAE401 - Inventory Management System

A complete web application for inventory management built according to SAE401 specifications.

## 🚀 Features

- **REST API**: Complete RESTful API with JSON responses for all CRUD operations
- **Doctrine ORM**: Object-Relational Mapping for clean database interactions
- **Bootstrap Framework**: Responsive design with modern UI components
- **JavaScript Integration**: Vanilla JavaScript with JSDoc for API communication
- **W3C Compliance**: Valid HTML5 and CSS3 following web standards
- **MVC Architecture**: Clean separation of concerns with Model-View-Controller pattern
- **Multi-store Support**: Manage inventory across multiple store locations
- **Employee Management**: Assign employees to stores with role-based access

## 📁 Project Structure

```
SAE401/
├── API/                    # REST API backend
│   ├── public/
│   │   ├── index.php       # API entry point
│   │   └── .htaccess       # URL rewriting
│   ├── src/
│   │   ├── Controller/
│   │   │   └── ApiController.php
│   │   └── Entity/         # Doctrine entities
│   │       ├── Brand.php
│   │       ├── Category.php
│   │       ├── Employee.php
│   │       ├── Product.php
│   │       ├── Stock.php
│   │       └── Store.php
│   ├── bootstrap.php       # Doctrine setup
│   ├── composer.json
│   └── vendor/             # Composer dependencies
├── Site/                   # Frontend web interface
│   ├── index.php           # Main entry point
│   ├── js/
│   │   └── app.js          # JavaScript API client
│   ├── css/
│   │   └── style.css       # Custom styles
│   ├── images/
│   │   └── logo.png        # Application logo
│   ├── views/
│   │   ├── layout.php      # HTML template
│   │   └── home.php        # Home page content
│   └── .htaccess           # URL rewriting
└── README.md               # This file
```

## 🛠️ Technology Stack

- **Backend**: PHP 8+ with Doctrine ORM
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, Bootstrap 5, Vanilla JavaScript
- **API**: RESTful JSON API
- **Server**: Apache/Nginx with URL rewriting

## 📋 Requirements

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)
- URL rewriting enabled

## 🚀 Installation

1. **Clone or download** the project files

2. **Set up the database**:
   - Create a MySQL database
   - Import the `SAE401.sql` schema file

3. **Configure the API**:
   ```bash
   cd API
   composer install
   ```
   - Update database connection settings in `API/bootstrap.php`

4. **Configure the web server**:
   - Ensure URL rewriting is enabled
   - Point document root to the `Site/` directory for the frontend
   - Point a subdomain or separate directory to `API/public/` for the API

5. **Access the application**:
   - Frontend: `http://your-domain.com/`
   - API: `http://api.your-domain.com/`

## 📖 API Documentation

### Endpoints

All API endpoints return JSON responses.

#### Products
- `GET /api/products` - List all products
- `GET /api/products/{id}` - Get product by ID
- `POST /api/products` - Create new product
- `PUT /api/products/{id}` - Update product
- `DELETE /api/products/{id}` - Delete product

#### Stores
- `GET /api/stores` - List all stores
- `GET /api/stores/{id}` - Get store by ID
- `POST /api/stores` - Create new store
- `PUT /api/stores/{id}` - Update store
- `DELETE /api/stores/{id}` - Delete store

#### Employees
- `GET /api/employees` - List all employees
- `GET /api/employees/{id}` - Get employee by ID
- `POST /api/employees` - Create new employee
- `PUT /api/employees/{id}` - Update employee
- `DELETE /api/employees/{id}` - Delete employee

#### Brands
- `GET /api/brands` - List all brands
- `GET /api/brands/{id}` - Get brand by ID
- `POST /api/brands` - Create new brand
- `PUT /api/brands/{id}` - Update brand
- `DELETE /api/brands/{id}` - Delete brand

#### Categories
- `GET /api/categories` - List all categories
- `GET /api/categories/{id}` - Get category by ID
- `POST /api/categories` - Create new category
- `PUT /api/categories/{id}` - Update category
- `DELETE /api/categories/{id}` - Delete category

#### Stock
- `GET /api/stocks` - List all stock entries
- `GET /api/stocks/{id}` - Get stock entry by ID
- `POST /api/stocks` - Create new stock entry
- `PUT /api/stocks/{id}` - Update stock entry
- `DELETE /api/stocks/{id}` - Delete stock entry

### Request/Response Format

#### Create/Update Request Body
```json
{
  "field_name": "value",
  "another_field": "another_value"
}
```

#### Success Response
```json
{
  "success": true,
  "message": "Operation completed successfully",
  "data": { ... }
}
```

#### Error Response
```json
{
  "success": false,
  "message": "Error description"
}
```

## 🎨 Frontend Features

- **Responsive Design**: Works on all screen sizes
- **Modern UI**: Bootstrap 5 components
- **Single Page Application**: No page reloads
- **Real-time Updates**: Immediate feedback for all operations
- **Form Validation**: Client-side validation
- **Error Handling**: User-friendly error messages

## 🔧 Development

### JavaScript API Client

The frontend uses a custom JavaScript API client (`Site/js/app.js`) with the following features:

- JSDoc documentation
- Promise-based API calls
- Automatic error handling
- Loading indicators
- Success/error notifications

### CSS Customization

Custom styles are in `Site/css/style.css` and include:

- Bootstrap variable overrides
- Responsive design enhancements
- Accessibility improvements
- Animation effects

## 📝 SAE401 Compliance

This application fully complies with SAE401 requirements:

- ✅ MVC architecture
- ✅ REST API with JSON responses
- ✅ Bootstrap CSS framework
- ✅ JavaScript API calls (Vanilla JS with JSDoc)
- ✅ English language throughout
- ✅ W3C compliant HTML/CSS
- ✅ Proper directory structure
- ✅ Database schema compliance
- ✅ Responsive design

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Test thoroughly
5. Submit a pull request

## 📄 License

This project is developed for educational purposes as part of the SAE401 curriculum.

## 👥 Authors

SAE401 Team

---

**Note**: This application requires a web server with PHP and MySQL support. For development, you can use PHP's built-in server or tools like XAMPP/WAMP.
