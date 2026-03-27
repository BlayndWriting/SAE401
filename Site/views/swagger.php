<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h2 class="card-title">Swagger API Documentation</h2>
        <p class="card-text">This page includes Swagger UI for the REST API. It loads the OpenAPI JSON from <code>/API/public/bikestores/openapi.json</code>.</p>
    </div>
</div>

<div id="swagger-ui"></div>

<!-- Swagger UI assets -->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.21.0/swagger-ui.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.21.0/swagger-ui-bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/4.21.0/swagger-ui-standalone-preset.js"></script>

<script>
/**
 * Initialize Swagger UI
 */
window.onload = function() {
    const ui = SwaggerUIBundle({
        url: '../API/public/bikestores/openapi.json',
        dom_id: '#swagger-ui',
        presets: [
            SwaggerUIBundle.presets.apis,
            SwaggerUIStandalonePreset
        ],
        layout: 'StandaloneLayout',
        deepLinking: true,
        docExpansion: 'none',
        operationsSorter: 'alpha',
        tryItOutEnabled: true,
        requestInterceptor: (req) => {
            // Add API key for writable operations
            if (req.method !== 'GET') {
                req.headers['X-API-Key'] = 'e8f1997c763';
            }
            return req;
        }
    });
    window.ui = ui;
};
</script>
