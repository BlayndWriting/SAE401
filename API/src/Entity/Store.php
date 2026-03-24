<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stores")
 */
class Store {
    /** 
     * @ORM\id
     * @ORM\Column(type="integer")
     * @ORM\GenerateId
     */
    private int $store_id;

    /** 
     * @ORM\Column(type="string")
     */
    private string $store_name;

    /** 
     * @ORM\Column(type="string")
     */
    private string $store_address;

    /** 
     * @ORM\Column(type="string")
     */
    private string $store_city;

    /** 
     * @ORM\Column(type="string")
     */
    private string $store_phone;

    public function __toString(): string {
        return "Store {$this->store_id} {$this->store_name}\n";
    }

    /**
     * Get store_id.
     * 
     * @return integer
     */
    public function getStoreId(): ?int {
        return $this->store_id ?? null;
    }

    /**
     * Get store_name.
     * 
     * @return string
     */
    public function getStoreName(): ?string {
        return $this->store_name ?? null;
    }

    /**
     * Get store_address.
     * 
     * @return string
     */
    public function getStoreAddress(): ?string {
        return $this->store_address ?? null;
    }

    /**
     * Get store_city.
     * 
     * @return string
     */
    public function getStoreCity(): ?string {
        return $this->store_city ?? null;
    }

    /**
     * Get store_phone.
     * 
     * @return string
     */
    public function getStorePhone(): ?string {
        return $this->store_phone ?? null;
    }

    /**
     * Set store_id.
     * 
     * @param integer $store_id
     * 
     * @return Store
     */
    public function setStoreId(int $store_id): void {
        $this->store_id = $store_id;
    }

    /**
     * Set store_name.
     * 
     * @param string $store_name
     * 
     * @return Store
     */
    public function setStoreName(string $store_name): void {
        $this->store_name = $store_name;
    }

    /**
     * Set store_address.
     * 
     * @param string $store_address
     * 
     * @return Store
     */
    public function setStoreAddress(string $store_address): void {
        $this->store_address = $store_address;
    }

    /**
     * Set store_city.
     * 
     * @param string $store_city
     * 
     * @return Store
     */
    public function setStoreCity(string $store_city): void {
        $this->store_city = $store_city;
    }

    /**
     * Set store_phone.
     * 
     * @param string $store_phone
     * 
     * @return Store
     */
    public function setStorePhone(string $store_phone): void {
        $this->store_phone = $store_phone;
    }
}
?>
