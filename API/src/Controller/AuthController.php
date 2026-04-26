<?php

namespace SAE401\BikestoresApi\Controller;

use SAE401\BikestoresApi\Model\Entity\Employee;
use SAE401\BikestoresApi\View\JsonView;
use SAE401\BikestoresApi\Utils\ApiResponse;

/**
 * Manages authentication-related endpoints.
 */
class AuthController
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
     * Authenticates an employee using email and password.
     *
     * @return void
     */
    public function login()
    {
        $body = json_decode(file_get_contents("php://input"), true);

        if (!$body) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Invalid JSON"])
            );
            return;
        }

        $email = $body["employee_email"] ?? null;
        $password = $body["employee_password"] ?? null;

        if (!$email || !$password) {
            JsonView::render(
                new ApiResponse(400, ["error" => "Missing email or password"])
            );
            return;
        }

        $repo = $this->entityManager->getRepository(Employee::class);

        $employee = $repo->findOneBy([
            "employee_email" => $email,
            "employee_password" => $password
        ]);

        if (!$employee) {
            JsonView::render(
                new ApiResponse(401, ["error" => "Invalid credentials"])
            );
            return;
        }

        $data = [
            "message" => "Login successful",
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
}