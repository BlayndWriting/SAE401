<?php

namespace SAE401\BikestoresApi\Controller;

use SAE401\BikestoresApi\Model\Entity\Brand;
use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;
use SAE401\BikestoresApi\Utils\ApiKeyMiddleware;

/**
 * Exposes CRUD operations for brands.
 */
class BrandController {

    /**
     * Doctrine entity manager instance.
     *
     * @var mixed
     */
    private $entityManager;

    /**
     * @param mixed $entityManager Doctrine entity manager.
     */
    public function __construct($entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * Returns all brands.
     *
     * @return void
     */
    public function getAll(){

        $repo = $this->entityManager->getRepository(Brand::class);
        $brands = $repo->findAll();

        $data = [];

        foreach($brands as $b){
            $data[] = [
                "brand_id"=>$b->getBrandId(),
                "brand_name"=>$b->getBrandName()
            ];
        }

        JsonView::render(
            new ApiResponse(200,$data)
        );
    }

    /**
     * Returns one brand by its identifier.
     *
     * @param int|string $id Brand identifier.
     *
     * @return void
     */
    public function getById($id){

        $repo = $this->entityManager->getRepository(Brand::class);
        $brand = $repo->find($id);

        if(!$brand){
            JsonView::render(
                new ApiResponse(404,["error"=>"Brand not found"])
            );
            return;
        }

        $data = [
            "brand_id"=>$brand->getBrandId(),
            "brand_name"=>$brand->getBrandName()
        ];

        JsonView::render(
            new ApiResponse(200,$data)
        );
    }

    /**
     * Creates a new brand.
     *
     * @return void
     */
    public function create()
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body["brand_name"])) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing brand_name"])
            );
            return;
        }

        $brand = new Brand();
        $brand->setBrandName($body["brand_name"]);

        $this->entityManager->persist($brand);
        $this->entityManager->flush();

        $data = [
            "message" => "Brand created successfully",
            "brand" => [
                "brand_id" => $brand->getBrandId(),
                "brand_name" => $brand->getBrandName()
            ]
        ];

        JsonView::render(
            new ApiResponse(201, $data)
        );
    }

    /**
     * Updates an existing brand.
     *
     * @param int|string $id Brand identifier.
     *
     * @return void
     */
    public function update($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Brand::class);
        $brand = $repo->find($id);

        if (!$brand) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Brand not found"])
            );
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body["brand_name"])) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing brand_name"])
            );
            return;
        }

        $brand->setBrandName($body["brand_name"]);

        $this->entityManager->flush();

        $data = [
            "message" => "Brand updated successfully",
            "brand" => [
                "brand_id" => $brand->getBrandId(),
                "brand_name" => $brand->getBrandName()
            ]
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Deletes a brand.
     *
     * @param int|string $id Brand identifier.
     *
     * @return void
     */
    public function delete($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Brand::class);
        $brand = $repo->find($id);

        if (!$brand) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Brand not found"])
            );
            return;
        }

        $this->entityManager->remove($brand);
        $this->entityManager->flush();

        JsonView::render(
            new ApiResponse(200, ["message" => "Brand deleted successfully"])
        );
    }

}