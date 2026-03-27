<div class="text-center mb-5">
    <h1 class="display-4 mb-3">Welcome to SAE401 Inventory Management System</h1>
    <p class="lead text-muted mb-4">
        A complete web application built with PHP, Doctrine ORM, REST API, and Bootstrap framework
    </p>
    <img src="images/logo.png" alt="SAE401 Logo" class="mb-4" style="max-width: 150px; height: auto;">
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <svg width="64" height="64" fill="currentColor" class="text-primary">
                        <use xlink:href="#box-seam"></use>
                    </svg>
                </div>
                <h5 class="card-title">Product Management</h5>
                <p class="card-text">Manage your product catalog with brands, categories, and detailed information.</p>
                <a href="?page=list&resource=products" class="btn btn-primary">View Products</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <svg width="64" height="64" fill="currentColor" class="text-success">
                        <use xlink:href="#shop"></use>
                    </svg>
                </div>
                <h5 class="card-title">Store Management</h5>
                <p class="card-text">Handle multiple store locations and employee assignments across your network.</p>
                <a href="?page=list&resource=stores" class="btn btn-success">View Stores</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body text-center">
                <div class="mb-3">
                    <svg width="64" height="64" fill="currentColor" class="text-warning">
                        <use xlink:href="#graph-up"></use>
                    </svg>
                </div>
                <h5 class="card-title">Stock Management</h5>
                <p class="card-text">Track inventory levels across all stores and manage stock movements efficiently.</p>
                <a href="?page=list&resource=stocks" class="btn btn-warning">View Stock</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">System Features</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <h6 class="text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i>REST API
                        </h6>
                        <p class="small text-muted mb-3">Complete RESTful API with JSON responses for all CRUD operations.</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i>Doctrine ORM
                        </h6>
                        <p class="small text-muted mb-3">Object-Relational Mapping for clean database interactions.</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i>Bootstrap Framework
                        </h6>
                        <p class="small text-muted mb-3">Responsive design with modern UI components.</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i>JavaScript Integration
                        </h6>
                        <p class="small text-muted mb-3">Vanilla JavaScript with JSDoc for API communication.</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i>W3C Compliance
                        </h6>
                        <p class="small text-muted mb-3">Valid HTML5 and CSS3 following web standards.</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i>MVC Architecture
                        </h6>
                        <p class="small text-muted mb-3">Clean separation of concerns with Model-View-Controller pattern.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons SVG sprites for icons -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="box-seam" viewBox="0 0 16 16">
        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.836L1 4.239v7.922l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
    </symbol>
    <symbol id="shop" viewBox="0 0 16 16">
        <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1h-12a.5.5 0 0 1 0-1H1.5V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
    </symbol>
    <symbol id="graph-up" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z"/>
    </symbol>
</svg>
