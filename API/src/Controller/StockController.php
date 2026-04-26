<?php

namespace SAE401\BikestoresApi\Controller;

use SAE401\BikestoresApi\Model\Entity\Stock;
use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;
use SAE401\BikestoresApi\Model\Entity\Store;
use SAE401\BikestoresApi\Model\Entity\Product;
use SAE401\BikestoresApi\Utils\ApiKeyMiddleware;

/**
 * Exposes CRUD operations for stocks.
 */
class StockController
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
     * Returns all stocks.
     *
     * @return void
     */
    public function getAll()
    {
        $repo = $this->entityManager->getRepository(Stock::class);
        $qb = $repo->createQueryBuilder('s')
            ->join('s.store', 'st')
            ->join('s.product', 'p');
    
        $stocks = $qb->getQuery()->getResult();
    
        $data = [];
    
        foreach ($stocks as $s) {
            $data[] = [
                "stock_id" => $s->getStockId(),
                "store_id" => $s->getStore()->getStoreId(),
                "store_name" => $s->getStore()->getStoreName(),
                "product_id" => $s->getProduct()->getProductId(),
                "product_name" => $s->getProduct()->getProductName(),
                "quantity" => $s->getQuantity()
            ];
        }
    
        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Returns one stock entry by its identifier.
     *
     * @param int|string $id Stock identifier.
     *
     * @return void
     */
    public function getById($id)
    {
        $repo = $this->entityManager->getRepository(Stock::class);
        $stock = $repo->find($id);

        if (!$stock) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Stock not found"])
            );
            return;
        }

        $data = [
            "stock_id" => $stock->getStockId(),
            "store_id" => $stock->getStore()->getStoreId(),
            "store_name" => $stock->getStore()->getStoreName(),
            "product_id" => $stock->getProduct()->getProductId(),
            "product_name" => $stock->getProduct()->getProductName(),
            "quantity" => $stock->getQuantity()
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Creates a new stock entry.
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
            empty($body["store_id"]) ||
            empty($body["product_id"]) ||
            !isset($body["quantity"])
        ) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing required fields"])
            );
            return;
        }

        $storeRepo = $this->entityManager->getRepository(Store::class);
        $productRepo = $this->entityManager->getRepository(Product::class);

        $store = $storeRepo->find($body["store_id"]);
        $product = $productRepo->find($body["product_id"]);

        if (!$store) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Store not found"])
            );
            return;
        }

        if (!$product) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Product not found"])
            );
            return;
        }

        $stock = new Stock();
        $stock->setStore($store);
        $stock->setProduct($product);
        $stock->setQuantity((int)$body["quantity"]);

        $this->entityManager->persist($stock);
        $this->entityManager->flush();

        $data = [
            "message" => "Stock entry created successfully",
            "stock" => [
                "stock_id" => $stock->getStockId(),
                "store_id" => $stock->getStore()->getStoreId(),
                "store_name" => $stock->getStore()->getStoreName(),
                "product_id" => $stock->getProduct()->getProductId(),
                "product_name" => $stock->getProduct()->getProductName(),
                "quantity" => $stock->getQuantity()
            ]
        ];

        JsonView::render(
            new ApiResponse(201, $data)
        );
    }

    /**
     * Updates an existing stock entry.
     *
     * @param int|string $id Stock identifier.
     *
     * @return void
     */
    public function update($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Stock::class);
        $stock = $repo->find($id);

        if (!$stock) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Stock not found"])
            );
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (
            !$body ||
            empty($body["store_id"]) ||
            empty($body["product_id"]) ||
            !isset($body["quantity"])
        ) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing required fields"])
            );
            return;
        }

        $storeRepo = $this->entityManager->getRepository(Store::class);
        $productRepo = $this->entityManager->getRepository(Product::class);

        $store = $storeRepo->find($body["store_id"]);
        $product = $productRepo->find($body["product_id"]);

        if (!$store) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Store not found"])
            );
            return;
        }

        if (!$product) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Product not found"])
            );
            return;
        }

        $stock->setStore($store);
        $stock->setProduct($product);
        $stock->setQuantity((int)$body["quantity"]);

        $this->entityManager->flush();

        $data = [
            "message" => "Stock entry updated successfully",
            "stock" => [
                "stock_id" => $stock->getStockId(),
                "store_id" => $stock->getStore()->getStoreId(),
                "store_name" => $stock->getStore()->getStoreName(),
                "product_id" => $stock->getProduct()->getProductId(),
                "product_name" => $stock->getProduct()->getProductName(),
                "quantity" => $stock->getQuantity()
            ]
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Deletes a stock entry.
     *
     * @param int|string $id Stock identifier.
     *
     * @return void
     */
    public function delete($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Stock::class);
        $stock = $repo->find($id);

        if (!$stock) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Stock not found"])
            );
            return;
        }

        $this->entityManager->remove($stock);
        $this->entityManager->flush();

        JsonView::render(
            new ApiResponse(200, ["message" => "Stock entry deleted successfully"])
        );
    }
}