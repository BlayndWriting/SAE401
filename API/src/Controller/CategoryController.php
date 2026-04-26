<?php

namespace SAE401\BikestoresApi\Controller;

use SAE401\BikestoresApi\Model\Entity\Category;
use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;
use SAE401\BikestoresApi\Utils\ApiKeyMiddleware;

/**
 * Exposes CRUD operations for categories.
 */
class CategoryController {

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
     * Returns all categories.
     *
     * @return void
     */
    public function getAll(){

        $repo = $this->entityManager->getRepository(Category::class);
        $categories = $repo->findAll();

        $data = [];

        foreach($categories as $c){
            $data[] = [
                "category_id"=>$c->getCategoryId(),
                "category_name"=>$c->getCategoryName()
            ];
        }

        JsonView::render(
            new ApiResponse(200,$data)
        );
    }

    /**
     * Returns one category by its identifier.
     *
     * @param int|string $id Category identifier.
     *
     * @return void
     */
    public function getById($id){

        $repo = $this->entityManager->getRepository(Category::class);
        $category = $repo->find($id);

        if(!$category){
            JsonView::render(
                new ApiResponse(404,["error"=>"Category not found"])
            );
            return;
        }

        $data = [
            "category_id"=>$category->getCategoryId(),
            "category_name"=>$category->getCategoryName()
        ];

        JsonView::render(
            new ApiResponse(200,$data)
        );
    }

    /**
     * Creates a new category.
     *
     * @return void
     */
    public function create()
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body["category_name"])) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing category_name"])
            );
            return;
        }

        $category = new Category();
        $category->setCategoryName($body["category_name"]);

        $this->entityManager->persist($category);
        $this->entityManager->flush();

        $data = [
            "message" => "Category created successfully",
            "category" => [
                "category_id" => $category->getCategoryId(),
                "category_name" => $category->getCategoryName()
            ]
        ];

        JsonView::render(
            new ApiResponse(201, $data)
        );
    }

    /**
     * Updates an existing category.
     *
     * @param int|string $id Category identifier.
     *
     * @return void
     */
    public function update($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Category::class);
        $category = $repo->find($id);

        if (!$category) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Category not found"])
            );
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body || empty($body["category_name"])) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing category_name"])
            );
            return;
        }

        $category->setCategoryName($body["category_name"]);

        $this->entityManager->flush();

        $data = [
            "message" => "Category updated successfully",
            "category" => [
                "category_id" => $category->getCategoryId(),
                "category_name" => $category->getCategoryName()
            ]
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Deletes a category.
     *
     * @param int|string $id Category identifier.
     *
     * @return void
     */
    public function delete($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Category::class);
        $category = $repo->find($id);

        if (!$category) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Category not found"])
            );
            return;
        }

        $this->entityManager->remove($category);
        $this->entityManager->flush();

        JsonView::render(
            new ApiResponse(200, ["message" => "Category deleted successfully"])
        );
    }

}