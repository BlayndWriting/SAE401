<?php

namespace SAE401\BikestoresApi\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "stores")]
/**
 * Store domain entity.
 */
class Store
{
    #[ORM\Id]
    #[ORM\Column(name: "store_id", type: "integer")]
    #[ORM\GeneratedValue]
    private int $store_id;

    #[ORM\Column(name: "store_name", type: "string", length: 255)]
    private string $store_name;

    #[ORM\Column(name: "phone", type: "string", length: 25, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(name: "email", type: "string", length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(name: "street", type: "string", length: 255, nullable: true)]
    private ?string $street = null;

    #[ORM\Column(name: "city", type: "string", length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(name: "state", type: "string", length: 10, nullable: true)]
    private ?string $state = null;

    #[ORM\Column(name: "zip_code", type: "string", length: 5, nullable: true)]
    private ?string $zip_code = null;

    /**
     * Returns a readable string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        return "Store {$this->store_id} {$this->store_name}\n";
    }

    /**
     * @param int $store_id Store identifier.
     *
     * @return self
     */
    public function setStoreId(int $store_id): self
    {
        $this->store_id = $store_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->store_id;
    }

    /**
     * @param string $store_name Store name.
     *
     * @return self
     */
    public function setStoreName(string $store_name): self
    {
        $this->store_name = $store_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->store_name;
    }

    /**
     * @param string|null $phone Store phone number.
     *
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $email Store email address.
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $street Street address.
     *
     * @return self
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $city City name.
     *
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $state State code.
     *
     * @return self
     */
    public function setState(?string $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $zip_code Zip code.
     *
     * @return self
     */
    public function setZipCode(?string $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }
}

    /**
     * @param int $store_id Store identifier.
     *
     * @return self
     */
    public function setStoreId(int $store_id): self
    {
        $this->store_id = $store_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getStoreId(): int
    {
        return $this->store_id;
    }

    /**
     * @param string $store_name Store name.
     *
     * @return self
     */
    public function setStoreName(string $store_name): self
    {
        $this->store_name = $store_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getStoreName(): string
    {
        return $this->store_name;
    }

    /**
     * @param string|null $phone Phone.
     *
     * @return self
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $email Email.
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $street Street.
     *
     * @return self
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $city City.
     *
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $state State.
     *
     * @return self
     */
    public function setState(?string $state): self
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param string|null $zip_code Zip code.
     *
     * @return self
     */
    public function setZipCode(?string $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zip_code;
    }
}