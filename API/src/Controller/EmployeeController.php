<?php

namespace SAE401\BikestoresApi\Controller;

use SAE401\BikestoresApi\Model\Entity\Employee;
use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;
use SAE401\BikestoresApi\Model\Entity\Store;
use SAE401\BikestoresApi\Utils\ApiKeyMiddleware;

/**
 * Exposes CRUD operations for employees.
 */
class EmployeeController
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
     * Returns all employees.
     *
     * @return void
     */
    public function getAll()
    {
        $repo = $this->entityManager->getRepository(Employee::class);
        $qb = $repo->createQueryBuilder('e')
            ->join('e.store', 's');
    
        $employees = $qb->getQuery()->getResult();
    
        $data = [];
    
        foreach ($employees as $e) {
            $data[] = [
                "employee_id" => $e->getEmployeeId(),
                "employee_name" => $e->getEmployeeName(),
                "employee_email" => $e->getEmployeeEmail(),
                "employee_role" => $e->getEmployeeRole(),
                "store_id" => $e->getStore()->getStoreId(),
                "store_name" => $e->getStore()->getStoreName()
            ];
        }
    
        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Returns one employee by its identifier.
     *
     * @param int|string $id Employee identifier.
     *
     * @return void
     */
    public function getById($id)
    {
        $repo = $this->entityManager->getRepository(Employee::class);
        $employee = $repo->find($id);

        if (!$employee) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Employee not found"])
            );
            return;
        }

        $data = [
            "employee_id" => $employee->getEmployeeId(),
            "employee_name" => $employee->getEmployeeName(),
            "employee_email" => $employee->getEmployeeEmail(),
            "employee_role" => $employee->getEmployeeRole(),
            "store_id" => $employee->getStore()->getStoreId(),
            "store_name" => $employee->getStore()->getStoreName()
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Creates a new employee.
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
            empty($body["employee_name"]) ||
            empty($body["employee_email"]) ||
            empty($body["employee_password"]) ||
            empty($body["employee_role"]) ||
            empty($body["store_id"])
        ) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing required fields"])
            );
            return;
        }

        $storeRepo = $this->entityManager->getRepository(Store::class);
        $store = $storeRepo->find($body["store_id"]);

        if (!$store) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Store not found"])
            );
            return;
        }

        $employee = new Employee();
        $employee->setEmployeeName($body["employee_name"]);
        $employee->setEmployeeEmail($body["employee_email"]);
        $employee->setEmployeePassword($body["employee_password"]);
        $employee->setEmployeeRole($body["employee_role"]);
        $employee->setStore($store);

        $this->entityManager->persist($employee);
        $this->entityManager->flush();

        $data = [
            "message" => "Employee created successfully",
            "employee" => [
                "employee_id" => $employee->getEmployeeId(),
                "employee_name" => $employee->getEmployeeName(),
                "employee_email" => $employee->getEmployeeEmail(),
                "employee_role" => $employee->getEmployeeRole(),
                "store_id" => $employee->getStore()->getStoreId(),
                "store_name" => $employee->getStore()->getStoreName()
            ]
        ];

        JsonView::render(
            new ApiResponse(201, $data)
        );
    }

    /**
     * Updates an existing employee.
     *
     * @param int|string $id Employee identifier.
     *
     * @return void
     */
    public function update($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Employee::class);
        $employee = $repo->find($id);

        if (!$employee) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Employee not found"])
            );
            return;
        }

        $body = json_decode(file_get_contents("php://input"), true);

        if (
            !$body ||
            empty($body["employee_name"]) ||
            empty($body["employee_email"]) ||
            empty($body["employee_password"]) ||
            empty($body["employee_role"]) ||
            empty($body["store_id"])
        ) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing required fields"])
            );
            return;
        }

        $storeRepo = $this->entityManager->getRepository(Store::class);
        $store = $storeRepo->find($body["store_id"]);

        if (!$store) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Store not found"])
            );
            return;
        }

        $employee->setEmployeeName($body["employee_name"]);
        $employee->setEmployeeEmail($body["employee_email"]);
        $employee->setEmployeePassword($body["employee_password"]);
        $employee->setEmployeeRole($body["employee_role"]);
        $employee->setStore($store);

        $this->entityManager->flush();

        $data = [
            "message" => "Employee updated successfully",
            "employee" => [
                "employee_id" => $employee->getEmployeeId(),
                "employee_name" => $employee->getEmployeeName(),
                "employee_email" => $employee->getEmployeeEmail(),
                "employee_role" => $employee->getEmployeeRole(),
                "store_id" => $employee->getStore()->getStoreId(),
                "store_name" => $employee->getStore()->getStoreName()
            ]
        ];

        JsonView::render(
            new ApiResponse(200, $data)
        );
    }

    /**
     * Deletes an employee.
     *
     * @param int|string $id Employee identifier.
     *
     * @return void
     */
    public function delete($id)
    {
        if (!ApiKeyMiddleware::check()) {
            return;
        }

        $repo = $this->entityManager->getRepository(Employee::class);
        $employee = $repo->find($id);

        if (!$employee) {
            JsonView::render(
                new ApiResponse(404, ["error" => "Employee not found"])
            );
            return;
        }

        $this->entityManager->remove($employee);
        $this->entityManager->flush();

        JsonView::render(
            new ApiResponse(200, ["message" => "Employee deleted successfully"])
        );
    }
}