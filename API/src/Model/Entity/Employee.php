<?php

namespace SAE401\BikestoresApi\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "employees")]
/**
 * Employee domain entity.
 */
class Employee
{
    #[ORM\Id]
    #[ORM\Column(name: "employee_id", type: "integer")]
    #[ORM\GeneratedValue]
    private int $employee_id;

    #[ORM\ManyToOne(targetEntity: Store::class)]
    #[ORM\JoinColumn(name: "store_id", referencedColumnName: "store_id", nullable: false)]
    private Store $store;

    #[ORM\Column(name: "employee_name", type: "string", length: 255)]
    private string $employee_name;

    #[ORM\Column(name: "employee_email", type: "string", length: 255)]
    private string $employee_email;

    #[ORM\Column(name: "employee_password", type: "string", length: 255)]
    private string $employee_password;

    #[ORM\Column(name: "employee_role", type: "string", length: 255)]
    private string $employee_role;

    /**
     * Returns a readable string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        $res = "Employee {$this->employee_id} {$this->employee_name} {$this->employee_email} ";
        $res .= "{$this->employee_password} {$this->employee_role} ";
        $res .= $this->store->getStoreId() . "\n";
        return $res;
    }

    /**
     * @param int $employee_id Employee identifier.
     *
     * @return self
     */
    public function setEmployeeId(int $employee_id): self
    {
        $this->employee_id = $employee_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmployeeId(): int
    {
        return $this->employee_id;
    }

    /**
     * @param Store $store Related store.
     *
     * @return self
     */
    public function setStore(Store $store): self
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @return Store
     */
    public function getStore(): Store
    {
        return $this->store;
    }

    /**
     * @param string $employee_name Employee full name.
     *
     * @return self
     */
    public function setEmployeeName(string $employee_name): self
    {
        $this->employee_name = $employee_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeName(): string
    {
        return $this->employee_name;
    }

    /**
     * @param string $employee_email Employee email address.
     *
     * @return self
     */
    public function setEmployeeEmail(string $employee_email): self
    {
        $this->employee_email = $employee_email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeEmail(): string
    {
        return $this->employee_email;
    }

    /**
     * @param string $employee_password Employee password hash or value.
     *
     * @return self
     */
    public function setEmployeePassword(string $employee_password): self
    {
        $this->employee_password = $employee_password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeePassword(): string
    {
        return $this->employee_password;
    }

    /**
     * @param string $employee_role Employee role label.
     *
     * @return self
     */
    public function setEmployeeRole(string $employee_role): self
    {
        $this->employee_role = $employee_role;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeRole(): string
    {
        return $this->employee_role;
    }
}

    /**
     * @param int $employee_id Employee identifier.
     *
     * @return self
     */
    public function setEmployeeId(int $employee_id): self
    {
        $this->employee_id = $employee_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getEmployeeId(): int
    {
        return $this->employee_id;
    }

    /**
     * @param Store $store Store.
     *
     * @return self
     */
    public function setStore(Store $store): self
    {
        $this->store = $store;
        return $this;
    }

    /**
     * @return Store
     */
    public function getStore(): Store
    {
        return $this->store;
    }

    /**
     * @param string $employee_name Employee name.
     *
     * @return self
     */
    public function setEmployeeName(string $employee_name): self
    {
        $this->employee_name = $employee_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeName(): string
    {
        return $this->employee_name;
    }

    /**
     * @param string $employee_email Employee email.
     *
     * @return self
     */
    public function setEmployeeEmail(string $employee_email): self
    {
        $this->employee_email = $employee_email;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeEmail(): string
    {
        return $this->employee_email;
    }

    /**
     * @param string $employee_password Employee password.
     *
     * @return self
     */
    public function setEmployeePassword(string $employee_password): self
    {
        $this->employee_password = $employee_password;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeePassword(): string
    {
        return $this->employee_password;
    }

    /**
     * @param string $employee_role Employee role.
     *
     * @return self
     */
    public function setEmployeeRole(string $employee_role): self
    {
        $this->employee_role = $employee_role;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmployeeRole(): string
    {
        return $this->employee_role;
    }
}