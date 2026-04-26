/**
 * SAE401 Inventory Management System - Frontend API Client
 * Handles all communication with the REST API backend
 * @author SAE401 Team
 * @version 1.0.0
 */

/**
 * Base API configuration
 * @constant {string} API_BASE_URL - Base URL for API endpoints
 */
const API_BASE_URL = '/SAE401';

/**
 * Available API resources
 * @constant {Object} RESOURCES - Mapping of resource names to their configurations
 */
const RESOURCES = {
    brands: { label: 'Brand', fields: ['brand_name'] },
    categories: { label: 'Category', fields: ['category_name'] },
    products: { label: 'Product', fields: ['product_name', 'category_id', 'brand_id', 'model_year', 'list_price'] },
    stores: { label: 'Store', fields: ['store_name', 'phone', 'email', 'street', 'city', 'state', 'zip_code'] },
    employees: { label: 'Employee', fields: ['store_id', 'employee_name', 'employee_email', 'employee_password', 'employee_role'] },
    stocks: { label: 'Stock', fields: ['product_id', 'store_id', 'quantity'] }
};

/**
 * Current application state
 * @type {Object}
 */
let appState = {
    currentResource: null,
    currentAction: 'list',
    currentId: null
};

/**
 * Initialize the application when DOM is loaded
 */
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

/**
 * Initialize the application
 * Sets up event listeners and loads initial content
 */
function initializeApp() {
    setupNavigation();
    setupEventListeners();
    loadInitialContent();
}

/**
 * Set up navigation event listeners
 */
function setupNavigation() {
    const navLinks = document.querySelectorAll('.main-nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', handleNavigation);
    });
}

/**
 * Set up general event listeners
 */
function setupEventListeners() {
    // Form submissions
    document.addEventListener('submit', handleFormSubmit);

    // Dynamic content updates
    document.addEventListener('click', handleDynamicClick);
}

/**
 * Handle navigation link clicks
 * @param {Event} event - The click event
 */
function handleNavigation(event) {
    event.preventDefault();
    const href = event.target.getAttribute('href');

    if (href === '?page=home') {
        loadHomePage();
    } else if (href === '?page=swagger') {
        loadSwaggerPage();
    } else {
        const urlParams = new URLSearchParams(href.split('?')[1]);
        const resource = urlParams.get('resource');
        const action = urlParams.get('action') || 'list';
        const id = urlParams.get('id');

        loadResourcePage(resource, action, id);
    }

    // Update URL without page reload
    history.pushState(null, '', href);
}

/**
 * Handle form submissions
 * @param {Event} event - The submit event
 */
function handleFormSubmit(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(form);

    const action = form.getAttribute('data-action');
    const resource = form.getAttribute('data-resource');
    const id = form.getAttribute('data-id');

    if (action === 'create') {
        createResource(resource, Object.fromEntries(formData));
    } else if (action === 'update') {
        updateResource(resource, id, Object.fromEntries(formData));
    } else if (action === 'delete') {
        const confirmDelete = confirm('Are you sure you want to delete this item?');
        if (confirmDelete) {
            deleteResource(resource, id);
        }
    }
}

/**
 * Handle dynamic click events
 * @param {Event} event - The click event
 */
function handleDynamicClick(event) {
    const target = event.target;

    // Handle delete button clicks
    if (target.classList.contains('btn-delete')) {
        event.preventDefault();
        const resource = target.getAttribute('data-resource');
        const id = target.getAttribute('data-id');
        const confirmDelete = confirm('Are you sure you want to delete this item?');
        if (confirmDelete) {
            deleteResource(resource, id);
        }
    }
}

/**
 * Load initial content based on current URL
 */
function loadInitialContent() {
    const urlParams = new URLSearchParams(window.location.search);
    const page = urlParams.get('page') || 'home';
    const resource = urlParams.get('resource');
    const action = urlParams.get('action') || 'list';
    const id = urlParams.get('id');

    if (page === 'home') {
        loadHomePage();
    } else if (page === 'swagger') {
        loadSwaggerPage();
    } else if (resource) {
        loadResourcePage(resource, action, id);
    }
}

/**
 * Load the home page
 */
function loadHomePage() {
    appState.currentResource = null;
    appState.currentAction = 'home';

    fetch('views/home.php')
        .then(response => response.text())
        .then(html => {
            document.querySelector('main').innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading home page:', error);
            showError('Failed to load home page');
        });
}

/**
 * Load Swagger documentation page
 */
function loadSwaggerPage() {
    appState.currentResource = null;
    appState.currentAction = 'swagger';

    fetch('views/swagger.php')
        .then(response => response.text())
        .then(html => {
            document.querySelector('main').innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading Swagger page:', error);
            showError('Failed to load API documentation page');
        });
}

/**
 * Load a resource page (list, create, edit)
 * @param {string} resource - The resource name
 * @param {string} action - The action (list, new, edit)
 * @param {string|null} id - The resource ID (for edit action)
 */
function loadResourcePage(resource, action, id) {
    if (!RESOURCES[resource]) {
        showError('Resource not found');
        return;
    }

    appState.currentResource = resource;
    appState.currentAction = action;
    appState.currentId = id;

    if (action === 'list') {
        loadResourceList(resource);
    } else if (action === 'new') {
        loadCreateForm(resource);
    } else if (action === 'edit' && id) {
        loadEditForm(resource, id);
    }
}

/**
 * Load and display a resource list
 * @param {string} resource - The resource name
 */
function loadResourceList(resource) {
    // Show loading indicator
    document.querySelector('main').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div></div>';

    // Fetch data from API
    apiGet(resource)
        .then(response => {
            if (response.success) {
                renderResourceList(resource, response.data);
            } else {
                throw new Error(response.error || 'Failed to load data');
            }
        })
        .catch(error => {
            console.error('Error loading resource list:', error);
            showError('Failed to load ' + RESOURCES[resource].label + ' list');
        });
}

/**
 * Load create form for a resource
 * @param {string} resource - The resource name
 */
function loadCreateForm(resource) {
    renderForm(resource, null, 'create');
}

/**
 * Load edit form for a resource
 * @param {string} resource - The resource name
 * @param {string} id - The resource ID
 */
function loadEditForm(resource, id) {
    // Show loading indicator
    document.querySelector('main').innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div></div>';

    // Fetch existing data
    apiGet(`${resource}/${id}`)
        .then(response => {
            if (response.success) {
                renderForm(resource, response.data, 'update', id);
            } else {
                throw new Error(response.error || 'Failed to load data');
            }
        })
        .catch(error => {
            console.error('Error loading edit form:', error);
            showError('Failed to load edit form');
        });
}

/**
 * Render a resource list
 * @param {string} resource - The resource name
 * @param {Array} data - The resource data array
 */
function renderResourceList(resource, data) {
    const config = RESOURCES[resource];
    const label = config.label;
    const fields = config.fields;

    let html = `
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>${label} List</h2>
            <a href="?page=list&resource=${resource}&action=new" class="btn btn-primary">Add ${label}</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>`;

    fields.forEach(field => {
        const displayName = field.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        html += `<th>${displayName}</th>`;
    });

    html += `<th>Actions</th></tr></thead><tbody>`;

    if (data.length === 0) {
        html += `<tr><td colspan="${fields.length + 2}" class="text-center">No items found.</td></tr>`;
    } else {
        data.forEach(item => {
            const id = item[`${resource.slice(0, -1)}_id`]; // Remove 's' and add '_id'
            html += `<tr><td>${id}</td>`;

            fields.forEach(field => {
                const value = item[field] || '';
                html += `<td>${value}</td>`;
            });

            html += `
                <td>
                    <a href="?page=list&resource=${resource}&action=edit&id=${id}" class="btn btn-sm btn-outline-primary me-2">Edit</a>
                    <button class="btn btn-sm btn-outline-danger btn-delete" data-resource="${resource}" data-id="${id}">Delete</button>
                </td>
            </tr>`;
        });
    }

    html += `</tbody></table></div>`;

    document.querySelector('main').innerHTML = html;
}

/**
 * Render a form for creating or editing a resource
 * @param {string} resource - The resource name
 * @param {Object|null} data - Existing data for editing (null for create)
 * @param {string} action - 'create' or 'update'
 * @param {string|null} id - Resource ID for updates
 */
function renderForm(resource, data, action, id = null) {
    const config = RESOURCES[resource];
    const label = config.label;
    const fields = config.fields;
    const submitText = action === 'create' ? 'Create' : 'Update';
    const title = `${submitText} ${label}`;

    let html = `<h2>${title}</h2>`;

    html += `<form data-action="${action}" data-resource="${resource}" ${id ? `data-id="${id}"` : ''}>`;

    if (id) {
        html += `<input type="hidden" name="${resource.slice(0, -1)}_id" value="${id}">`;
    }

    fields.forEach(field => {
        const displayName = field.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        const value = data ? (data[field] || '') : '';
        const inputType = field.includes('price') || field.includes('quantity') || field.includes('year') ? 'number' :
                         field.includes('email') ? 'email' :
                         field.includes('password') ? 'password' : 'text';

        html += `
            <div class="mb-3">
                <label for="${field}" class="form-label">${displayName}</label>
                <input type="${inputType}" class="form-control" id="${field}" name="${field}" value="${value}" required>
            </div>`;
    });

    html += `
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">${submitText}</button>
            <a href="?page=list&resource=${resource}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>`;

    document.querySelector('main').innerHTML = html;
}

/**
 * Create a new resource via API
 * @param {string} resource - The resource name
 * @param {Object} data - The resource data
 */
function createResource(resource, data) {
    apiPost(resource, data)
        .then(() => {
            showSuccess(`${RESOURCES[resource].label} created successfully`);
            loadResourceList(resource);
        })
        .catch(error => {
            console.error('Error creating resource:', error);
            showError('Failed to create ' + RESOURCES[resource].label);
        });
}

/**
 * Update an existing resource via API
 * @param {string} resource - The resource name
 * @param {string} id - The resource ID
 * @param {Object} data - The updated resource data
 */
function updateResource(resource, id, data) {
    apiPut(`${resource}/${id}`, data)
        .then(() => {
            showSuccess(`${RESOURCES[resource].label} updated successfully`);
            loadResourceList(resource);
        })
        .catch(error => {
            console.error('Error updating resource:', error);
            showError('Failed to update ' + RESOURCES[resource].label);
        });
}

/**
 * Delete a resource via API
 * @param {string} resource - The resource name
 * @param {string} id - The resource ID
 */
function deleteResource(resource, id) {
    apiDelete(`${resource}/${id}`)
        .then(() => {
            showSuccess(`${RESOURCES[resource].label} deleted successfully`);
            loadResourceList(resource);
        })
        .catch(error => {
            console.error('Error deleting resource:', error);
            showError('Failed to delete ' + RESOURCES[resource].label);
        });
}

/**
 * Make a GET request to the API
 * @param {string} endpoint - The API endpoint
 * @returns {Promise} - Promise resolving to JSON data
 */
function apiGet(endpoint) {
    return fetch(`${API_BASE_URL}/bikestores/${endpoint}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        });
}

/**
 * Make a POST request to the API
 * @param {string} endpoint - The API endpoint
 * @param {Object} data - The data to send
 * @returns {Promise} - Promise resolving to JSON response
 */
function apiPost(endpoint, data) {
    return fetch(`${API_BASE_URL}/bikestores/${endpoint}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-API-Key': 'e8f1997c763'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    });
}

/**
 * Make a PUT request to the API
 * @param {string} endpoint - The API endpoint
 * @param {Object} data - The data to send
 * @returns {Promise} - Promise resolving to JSON response
 */
function apiPut(endpoint, data) {
    return fetch(`${API_BASE_URL}/bikestores/${endpoint}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-API-Key': 'e8f1997c763'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    });
}

/**
 * Make a DELETE request to the API
 * @param {string} endpoint - The API endpoint
 * @param {Object} data - The data to send
 * @returns {Promise} - Promise resolving to empty response
 */
function apiDelete(endpoint) {
    return fetch(`${API_BASE_URL}/bikestores/${endpoint}`, {
        method: 'DELETE',
        headers: {
            'X-API-Key': 'e8f1997c763'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
    });
}

/**
 * Show a success message to the user
 * @param {string} message - The success message
 */
function showSuccess(message) {
    showAlert(message, 'success');
}

/**
 * Show an error message to the user
 * @param {string} message - The error message
 */
function showError(message) {
    showAlert(message, 'danger');
}

/**
 * Show an alert message
 * @param {string} message - The message to display
 * @param {string} type - The alert type (success, danger, warning, info)
 */
function showAlert(message, type) {
    const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>`;

    // Insert at the top of main content
    const main = document.querySelector('main');
    main.insertAdjacentHTML('afterbegin', alertHtml);

    // Auto-dismiss after 5 seconds
    setTimeout(() => {
        const alert = main.querySelector('.alert');
        if (alert) {
            alert.remove();
        }
    }, 5000);
}
