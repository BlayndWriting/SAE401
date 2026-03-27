<?php
/**
 * SAE401 Inventory Management System - Main Entry Point
 * Front controller for the web interface
 * @author SAE401 Team
 * @version 1.0.0
 */

// Start session for potential future use
session_start();

// Set content type and charset
header('Content-Type: text/html; charset=UTF-8');

// Define page title
$pageTitle = 'SAE401 - Inventory Management System';

// Include the main HTML template
include __DIR__ . '/views/layout.php';

