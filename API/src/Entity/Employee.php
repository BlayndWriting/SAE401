<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class Employee {
    /** 
     * @ORM\id
     * @ORM\Column(type="integer")
     * @ORM\GenerateId
     */
    private int $employee_id;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $store_id;
    
    /** 
     * @ORM\Column(type="string")
     */
    private string $employee_name;

    public function __tostring(): string {
        return "Employee {$this->employee_id} {$this->employee_name}\n";
    }

    /**
     * Get employee_id.
     * 
     * @return integer
     */
    public function getEmployeeId($employee_id): ?int {
        return $this->employee_id;
    }
    
    /**
     * Get store_id.
     * 
     * @return integer
     */
    public function getStoreId($store_id): ?int {
        return $this->store_id;
    }

    /**
     * Get employee_name.
     * 
     * @return string
     */
    public function getEmployeeName($employee_name): ?string {
        return $this->employee_name;
    }

    /**
     * Set employee_id.
     * 
     * @param integer $employee_id
     * 
     * @return Employee
     */
    public function setEmployeeId(int $employee_id): void {
        $this->employee_id = $employee_id;
    }

    /**
     * Set store_id.
     * 
     * @param integer $store_id
     * 
     * @return Employee
     */
    public function setStoreId(int $store_id): void {
        $this->store_id = $store_id;
    }

    /**
     * Set employee_name.
     * 
     * @param string $employee_name
     * 
     * @return Employee
     */
    public function setEmployeeName(string $employee_name): void {
        $this->employee_name = $employee_name;
    }
}
?>