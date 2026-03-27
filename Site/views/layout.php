<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SAE401 Inventory Management System - Complete web application with REST API">
    <meta name="author" content="SAE401 Team">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
</head>
<body>
    <!-- Header -->
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="?page=home">
                    <img src="images/logo.png" alt="SAE401 Logo" width="40" height="40" class="me-2">
                    SAE401 - Inventory Management
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="?page=home">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="productsDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Products
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="productsDropdown">
                                <li><a class="dropdown-item" href="?page=list&resource=products">View Products</a></li>
                                <li><a class="dropdown-item" href="?page=list&resource=brands">Brands</a></li>
                                <li><a class="dropdown-item" href="?page=list&resource=categories">Categories</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="storesDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                Stores
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="storesDropdown">
                                <li><a class="dropdown-item" href="?page=list&resource=stores">View Stores</a></li>
                                <li><a class="dropdown-item" href="?page=list&resource=employees">Employees</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=list&resource=stocks">Stock Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=swagger">API Docs</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Content will be loaded here by JavaScript -->
    </main>

    <!-- Footer -->
    <footer class="site-footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>SAE401 - Inventory Management System</h5>
                    <p>A complete web application built with PHP, Doctrine ORM, and Bootstrap.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p>&copy; 2024 SAE401 Team. All rights reserved.</p>
                    <p>
                        <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a> |
                        <a href="https://www.doctrine-project.org/" target="_blank">Doctrine ORM</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>

    <!-- Custom JavaScript -->
    <script src="js/app.js"></script>
</body>
</html>
