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
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $employee_id = null;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $store_id;
    
    /** 
     * @ORM\Column(type="string", length=255)
     */
    private string $employee_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $employee_email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $employee_password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $employee_role;

    public function __tostring(): string {
        return "Employee {$this->employee_id} {$this->employee_name}\n";
    }

    /**
     * Get employee_id.
     * 
     * @return integer|null
     */
    public function getEmployeeId(): ?int {
        return $this->employee_id;
    }
    
    /**
     * Get store_id.
     * 
     * @return integer|null
     */
    public function getStoreId(): ?int {
        return $this->store_id;
    }

    /**
     * Get employee_name.
     * 
     * @return string|null
     */
    public function getEmployeeName(): ?string {
        return $this->employee_name;
    }

    /**
     * Get employee_email.
     * 
     * @return string|null
     */
    public function getEmployeeEmail(): ?string {
        return $this->employee_email;
    }

    /**
     * Get employee_password.
     * 
     * @return string|null
     */
    public function getEmployeePassword(): ?string {
        return $this->employee_password;
    }

    /**
     * Get employee_role.
     * 
     * @return string|null
     */
    public function getEmployeeRole(): ?string {
        return $this->employee_role;
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