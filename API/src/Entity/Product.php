<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product {
    /** 
     * @ORM\id
     * @ORM\Column(type="integer")
     * @ORM\GenerateId
     */
    private int $product_id;

    /** 
     * @ORM\Column(type="string")
     */
    private string $product_name;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $category_id;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $brand_id;

    /** 
     * @ORM\Column(type="float")
     */
    private float $price;

    public function __toString(): string {
        return "Product {$this->product_id} {$this->product_name}\n";
    }

    /**
     * Get product_id.
     * 
     * @return integer
     */
    public function getProductId(): ?int {
        return $this->product_id ?? null;
    }

    /**
     * Get product_name.
     * 
     * @return string
     */
    public function getProductName(): ?string {
        return $this->product_name ?? null;
    }

    /**
     * Get category_id.
     * 
     * @return integer
     */
    public function getCategoryId(): ?int {
        return $this->category_id ?? null;
    }

    /**
     * Get brand_id.
     * 
     * @return integer
     */
    public function getBrandId(): ?int {
        return $this->brand_id ?? null;
    }

    /**
     * Get price.
     * 
     * @return float
     */
    public function getPrice(): ?float {
        return $this->price ?? null;
    }

    /**
     * Set product_id.
     * 
     * @param integer $product_id
     * 
     * @return Product
     */
    public function setProductId(int $product_id): void {
        $this->product_id = $product_id;
    }

    /**
     * Set product_name.
     * 
     * @param string $product_name
     * 
     * @return Product
     */
    public function setProductName(string $product_name): void {
        $this->product_name = $product_name;
    }

    /**
     * Set category_id.
     * 
     * @param integer $category_id
     * 
     * @return Product
     */
    public function setCategoryId(int $category_id): void {
        $this->category_id = $category_id;
    }

    /**
     * Set brand_id.
     * 
     * @param integer $brand_id
     * 
     * @return Product
     */
    public function setBrandId(int $brand_id): void {
        $this->brand_id = $brand_id;
    }

    /**
     * Set price.
     * 
     * @param float $price
     * 
     * @return Product
     */
    public function setPrice(float $price): void {
        $this->price = $price;
    }
}
?>
