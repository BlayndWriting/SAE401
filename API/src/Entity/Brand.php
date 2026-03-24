<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="brands")
 */

class Brand {
    /** @var string */
    /** 
     * @ORM\id
     * @ORM\Column(type="integer")
     * @ORM\GenerateId
     */
    private int $brand_id;

    /** 
     * @ORM\Column(type="string")
     */
    private string $brand_name;

    public function __tostring(): string {
        return "Brand {$this->brand_id} {$this->brand_name}\n";
    }

    /**
     * Get brand_id.
     * 
     * @return integer
     */
    public function getBrandId($brand_id): ?int {
        return $this->brand_id;
    }

    /**
     * Get brand_name.
     * 
     * @return string
     */
    public function getBrandName($brand_name): ?string {
        return $this->brand_name;
    }

    /**
     * Set brand_id.
     * 
     * @param string $brand_id
     * 
     * @return Brand
     */
    public function setBrandId(int $brand_id): void {
        $this->brand_id = $brand_id;
    }

    /**
     * Set brand_name.
     * 
     * @param string $brand_name
     * 
     * @return Brand
     */
    public function setBrandName(string $brand_name): void {
        $this->brand_name = $brand_name;
    }
}
?>