<?php
require_once __DIR__ . '/../bootstrap.php';

try {
    $repo = $entityManager->getRepository('Entity\Product');
    $products = $repo->findAll();
    echo "API works: " . count($products) . " products found\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>