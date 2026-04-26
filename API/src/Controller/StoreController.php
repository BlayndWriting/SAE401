<?php

namespace SAE401\BikestoresApi\Controller;

use SAE401\BikestoresApi\Model\Entity\Store;
use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;
use SAE401\BikestoresApi\Utils\ApiKeyMiddleware;

/**
 * Exposes CRUD operations for stores.
 */
class StoreController
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
     * Returns all stores.
     *
     * @return void
     */
    public function getAll()
    {
        $repo = $this->entityManager->getRepository(Store::class);
        $stores = $repo->findAll();

        $data = [];

        foreach ($stores as $s) {
            $data[] = [
                "store_id" => $s->getStoreId(),
                "store_name" => $s->getStoreName(),
                "phone" => $s->getPhone(),
                "email" => $s->getEmail(),
                "street" => $s->getStreet(),
                "city" => $s->getCity(),
                "state" => $s->getState(),
                "zip_code" => $s->getZipCode()
            ];
        }

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Returns one store by its identifier.
     *
     * @param int|string $id Store identifier.
     *
     * @return void
     */
    public function getById($id)
    {
        $repo = $this->entityManager->getRepository(Store::class);
        $store = $repo->find($id);

        if (!$store) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Store not found"])
            );
            return;
        }

        $data = [
            "store_id" => $store->getStoreId(),
            "store_name" => $store->getStoreName(),
            "phone" => $store->getPhone(),
            "email" => $store->getEmail(),
            "street" => $store->getStreet(),
            "city" => $store->getCity(),
            "state" => $store->getState(),
            "zip_code" => $store->getZipCode()
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Creates a new store.
     *
     * @return void
     */
    public function create()
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body["store_name"])) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing store_name"])
            );
            return;
        }

        $store = new Store();
        $store->setStoreName($body["store_name"]);
        if (isset($body["phone"])) $store->setPhone($body["phone"]);
        if (isset($body["email"])) $store->setEmail($body["email"]);
        if (isset($body["street"])) $store->setStreet($body["street"]);
        if (isset($body["city"])) $store->setCity($body["city"]);
        if (isset($body["state"])) $store->setState($body["state"]);
        if (isset($body["zip_code"])) $store->setZipCode($body["zip_code"]);

        $this->entityManager->persist($store);
        $this->entityManager->flush();

        $data = [
            "message" => "Store created successfully",
            "store" => [
                "store_id" => $store->getStoreId(),
                "store_name" => $store->getStoreName(),
                "phone" => $store->getPhone(),
                "email" => $store->getEmail(),
                "street" => $store->getStreet(),
                "city" => $store->getCity(),
                "state" => $store->getState(),
                "zip_code" => $store->getZipCode()
            ]
        ];

        JsonView::render(
            new ApiResponse(201, $data)
        );
    }

    /**
     * Updates an existing store.
     *
     * @param int|string $id Store identifier.
     *
     * @return void
     */
    public function update($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Store::class);
        $store = $repo->find($id);

        if (!$store) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Store not found"])
            );
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body["store_name"])) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing store_name"])
            );
            return;
        }

        $store->setStoreName($body["store_name"]);
        if (isset($body["phone"])) $store->setPhone($body["phone"]);
        if (isset($body["email"])) $store->setEmail($body["email"]);
        if (isset($body["street"])) $store->setStreet($body["street"]);
        if (isset($body["city"])) $store->setCity($body["city"]);
        if (isset($body["state"])) $store->setState($body["state"]);
        if (isset($body["zip_code"])) $store->setZipCode($body["zip_code"]);

        $this->entityManager->flush();

        $data = [
            "message" => "Store updated successfully",
            "store" => [
                "store_id" => $store->getStoreId(),
                "store_name" => $store->getStoreName(),
                "phone" => $store->getPhone(),
                "email" => $store->getEmail(),
                "street" => $store->getStreet(),
                "city" => $store->getCity(),
                "state" => $store->getState(),
                "zip_code" => $store->getZipCode()
            ]
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Deletes a store.
     *
     * @param int|string $id Store identifier.
     *
     * @return void
     */
    public function delete($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Store::class);
        $store = $repo->find($id);

        if (!$store) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Store not found"])
            );
            return;
        }

        $this->entityManager->remove($store);
        $this->entityManager->flush();

        JsonView::render(
            new ApiResponse(200, ["message" => "Store deleted successfully"])
        );
    }
}