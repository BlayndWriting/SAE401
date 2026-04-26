<?php

namespace SAE401\BikestoresApi\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "brands")]
/**
 * Brand domain entity.
 */
class Brand
{
    #[ORM\Id]
    #[ORM\Column(name: "brand_id", type: "integer")]
    #[ORM\GeneratedValue]
    private int $brand_id;

    #[ORM\Column(name: "brand_name", type: "string", length: 255)]
    private string $brand_name;

    /**
     * Returns a readable string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        return "Brand {$this->brand_id} {$this->brand_name}\n";
    }

    /**
     * @param int $brand_id Brand identifier.
     *
     * @return self
     */
    public function setBrandId(int $brand_id): self
    {
        $this->brand_id = $brand_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brand_id;
    }

    /**
     * @param string $brand_name Brand name.
     *
     * @return self
     */
    public function setBrandName(string $brand_name): self
    {
        $this->brand_name = $brand_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrandName(): string
    {
        return $this->brand_name;
    }
}

    /**
     * @param int $brand_id Brand identifier.
     *
     * @return self
     */
    public function setBrandId(int $brand_id): self
    {
        $this->brand_id = $brand_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getBrandId(): int
    {
        return $this->brand_id;
    }

    /**
     * @param string $brand_name Brand name.
     *
     * @return self
     */
    public function setBrandName(string $brand_name): self
    {
        $this->brand_name = $brand_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBrandName(): string
    {
        return $this->brand_name;
    }
}