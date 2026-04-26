<?php

namespace SAE401\BikestoresApi\Controller;

use SAE401\BikestoresApi\Model\Entity\Product;
use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;
use SAE401\BikestoresApi\Model\Entity\Brand;
use SAE401\BikestoresApi\Model\Entity\Category;
use SAE401\BikestoresApi\Utils\ApiKeyMiddleware;

/**
 * Exposes CRUD operations for products.
 */
class ProductController
{
    /**
     * Doctrine entity manager instance.
     *
     * @var mixed
     */
    private $entityManager;

    /**
     * @param mixed $entityManager Doctrine entity manager.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Returns all products with optional filters.
     *
     * @return void
     */
    public function getAll()
    {
        $repo = $this->entityManager->getRepository(Product::class);
        $qb = $repo->createQueryBuilder('p')
            ->join('p.brand', 'b')
            ->join('p.category', 'c');
    
        if (isset($_GET["brand_id"]) && $_GET["brand_id"] !== "") {
            $qb->andWhere('b.brand_id = :brand_id')
               ->setParameter('brand_id', $_GET["brand_id"]);
        }
    
        if (isset($_GET["category_id"]) && $_GET["category_id"] !== "") {
            $qb->andWhere('c.category_id = :category_id')
               ->setParameter('category_id', $_GET["category_id"]);
        }
    
        if (isset($_GET["model_year"]) && $_GET["model_year"] !== "") {
            $qb->andWhere('p.model_year = :model_year')
               ->setParameter('model_year', $_GET["model_year"]);
        }
    
        if (isset($_GET["price_min"]) && $_GET["price_min"] !== "") {
            $qb->andWhere('p.list_price >= :price_min')
               ->setParameter('price_min', $_GET["price_min"]);
        }
    
        if (isset($_GET["price_max"]) && $_GET["price_max"] !== "") {
            $qb->andWhere('p.list_price <= :price_max')
               ->setParameter('price_max', $_GET["price_max"]);
        }
    
        $products = $qb->getQuery()->getResult();
    
        $data = [];
    
        foreach ($products as $p) {
            $data[] = [
                "product_id" => $p->getProductId(),
                "product_name" => $p->getProductName(),
                "brand_id" => $p->getBrand()->getBrandId(),
                "brand_name" => $p->getBrand()->getBrandName(),
                "category_id" => $p->getCategory()->getCategoryId(),
                "category_name" => $p->getCategory()->getCategoryName(),
                "model_year" => $p->getModelYear(),
                "list_price" => $p->getListPrice()
            ];
        }
    
        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Returns one product by its identifier.
     *
     * @param int|string $id Product identifier.
     *
     * @return void
     */
    public function getById($id)
    {
        $repo = $this->entityManager->getRepository(Product::class);
        $product = $repo->find($id);

        if (!$product) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Product not found"])
            );
            return;
        }

        $data = [
            "product_id" => $product->getProductId(),
            "product_name" => $product->getProductName(),
            "brand_id" => $product->getBrand()->getBrandId(),
            "brand_name" => $product->getBrand()->getBrandName(),
            "category_id" => $product->getCategory()->getCategoryId(),
            "category_name" => $product->getCategory()->getCategoryName(),
            "model_year" => $product->getModelYear(),
            "list_price" => $product->getListPrice()
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Creates a new product.
     *
     * @return void
     */
    public function create()
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (
            !$body ||
            empty($body["product_name"]) ||
            empty($body["brand_id"]) ||
            empty($body["category_id"]) ||
            empty($body["model_year"]) ||
            !isset($body["list_price"])
        ) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing required fields"])
            );
            return;
        }

        $brandRepo = $this->entityManager->getRepository(Brand::class);
        $categoryRepo = $this->entityManager->getRepository(Category::class);

        $brand = $brandRepo->find($body["brand_id"]);
        $category = $categoryRepo->find($body["category_id"]);

        if (!$brand) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Brand not found"])
            );
            return;
        }

        if (!$category) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Category not found"])
            );
            return;
        }

        $product = new Product();
        $product->setProductName($body["product_name"]);
        $product->setBrand($brand);
        $product->setCategory($category);
        $product->setModelYear((int)$body["model_year"]);
        $product->setListPrice((string)$body["list_price"]);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        $data = [
            "message" => "Product created successfully",
            "product" => [
                "product_id" => $product->getProductId(),
                "product_name" => $product->getProductName(),
                "brand_id" => $product->getBrand()->getBrandId(),
                "brand_name" => $product->getBrand()->getBrandName(),
                "category_id" => $product->getCategory()->getCategoryId(),
                "category_name" => $product->getCategory()->getCategoryName(),
                "model_year" => $product->getModelYear(),
                "list_price" => $product->getListPrice()
            ]
        ];

        JsonView::render(
            new ApiResponse(201, $data)
        );
    }

    /**
     * Updates an existing product.
     *
     * @param int|string $id Product identifier.
     *
     * @return void
     */
    public function update($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Product::class);
        $product = $repo->find($id);

        if (!$product) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Product not found"])
            );
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (
            !$body ||
            empty($body["product_name"]) ||
            empty($body["brand_id"]) ||
            empty($body["category_id"]) ||
            empty($body["model_year"]) ||
            !isset($body["list_price"])
        ) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing required fields"])
            );
            return;
        }

        $brandRepo = $this->entityManager->getRepository(Brand::class);
        $categoryRepo = $this->entityManager->getRepository(Category::class);

        $brand = $brandRepo->find($body["brand_id"]);
        $category = $categoryRepo->find($body["category_id"]);

        if (!$brand) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Brand not found"])
            );
            return;
        }

        if (!$category) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Category not found"])
            );
            return;
        }

        $product->setProductName($body["product_name"]);
        $product->setBrand($brand);
        $product->setCategory($category);
        $product->setModelYear((int)$body["model_year"]);
        $product->setListPrice((string)$body["list_price"]);

        $this->entityManager->flush();

        $data = [
            "message" => "Product updated successfully",
            "product" => [
                "product_id" => $product->getProductId(),
                "product_name" => $product->getProductName(),
                "brand_id" => $product->getBrand()->getBrandId(),
                "brand_name" => $product->getBrand()->getBrandName(),
                "category_id" => $product->getCategory()->getCategoryId(),
                "category_name" => $product->getCategory()->getCategoryName(),
                "model_year" => $product->getModelYear(),
                "list_price" => $product->getListPrice()
            ]
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Deletes a product.
     *
     * @param int|string $id Product identifier.
     *
     * @return void
     */
    public function delete($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Product::class);
        $product = $repo->find($id);

        if (!$product) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Product not found"])
            );
            return;
        }

        $this->entityManager->remove($product);
        $this->entityManager->flush();

        JsonView::render(
            new ApiResponse(200, ["message" => "Product deleted successfully"])
        );
    }
}