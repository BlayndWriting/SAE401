<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stores")
 */
class Store {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $store_id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $store_name;

    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    private ?string $phone = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $street = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $city = null;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private ?string $state = null;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $zip_code = null;

    public function __toString(): string {
        return "Store {$this->store_id} {$this->store_name}\n";
    }

    /**
     * Get store_id.
     * 
     * @return integer|null
     */
    public function getStoreId(): ?int {
        return $this->store_id ?? null;
    }

    /**
     * Get store_name.
     * 
     * @return string|null
     */
    public function getStoreName(): ?string {
        return $this->store_name ?? null;
    }

    /**
     * Get phone.
     * 
     * @return string|null
     */
    public function getPhone(): ?string {
        return $this->phone;
    }

    /**
     * Get email.
     * 
     * @return string|null
     */
    public function getEmail(): ?string {
        return $this->email;
    }

    /**
     * Get street.
     * 
     * @return string|null
     */
    public function getStreet(): ?string {
        return $this->street;
    }

    /**
     * Get city.
     * 
     * @return string|null
     */
    public function getCity(): ?string {
        return $this->city;
    }

    /**
     * Get state.
     * 
     * @return string|null
     */
    public function getState(): ?string {
        return $this->state;
    }

    /**
     * Get zip_code.
     * 
     * @return string|null
     */
    public function getZipCode(): ?string {
        return $this->zip_code;
    }

    /**
     * Set store_id.
     * 
     * @param integer $store_id
     * @return void
     */
    public function setStoreId(int $store_id): void {
        $this->store_id = $store_id;
    }

    /**
     * Set store_name.
     * 
     * @param string $store_name
     * @return void
     */
    public function setStoreName(string $store_name): void {
        $this->store_name = $store_name;
    }

    /**
     * Set phone.
     * 
     * @param string|null $phone
     * @return void
     */
    public function setPhone(?string $phone): void {
        $this->phone = $phone;
    }

    /**
     * Set email.
     * 
     * @param string|null $email
     * @return void
     */
    public function setEmail(?string $email): void {
        $this->email = $email;
    }

    /**
     * Set street.
     * 
     * @param string|null $street
     * @return void
     */
    public function setStreet(?string $street): void {
        $this->street = $street;
    }

    /**
     * Set city.
     * 
     * @param string|null $city
     * @return void
     */
    public function setCity(?string $city): void {
        $this->city = $city;
    }

    /**
     * Set state.
     * 
     * @param string|null $state
     * @return void
     */
    public function setState(?string $state): void {
        $this->state = $state;
    }

    /**
     * Set zip_code.
     * 
     * @param string|null $zip_code
     * @return void
     */
    public function setZipCode(?string $zip_code): void {
        $this->zip_code = $zip_code;
    }
}
?>
