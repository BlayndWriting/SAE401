<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="products")
 */
class Product {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $product_id = null;

    /** 
     * @ORM\Column(type="string")
     */
    private string $product_name;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $brand_id;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $category_id;

    /**
     * @ORM\Column(type="smallint")
     */
    private int $model_year;

    /** 
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private float $list_price;

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
     * @return integer|null
     */
    public function getBrandId(): ?int {
        return $this->brand_id ?? null;
    }

    /**
     * Get model_year.
     * 
     * @return integer|null
     */
    public function getModelYear(): ?int {
        return $this->model_year ?? null;
    }

    /**
     * Get list_price.
     * 
     * @return float|null
     */
    public function getListPrice(): ?float {
        return $this->list_price ?? null;
    }

    /**
     * Set product_id.
     * 
     * @param integer $product_id
     * @return void
     */
    public function setProductId(int $product_id): void {
        $this->product_id = $product_id;
    }

    /**
     * Set product_name.
     * 
     * @param string $product_name
     * @return void
     */
    public function setProductName(string $product_name): void {
        $this->product_name = $product_name;
    }

    /**
     * Set category_id.
     * 
     * @param integer $category_id
     * @return void
     */
    public function setCategoryId(int $category_id): void {
        $this->category_id = $category_id;
    }

    /**
     * Set brand_id.
     * 
     * @param integer $brand_id
     * @return void
     */
    public function setBrandId(int $brand_id): void {
        $this->brand_id = $brand_id;
    }

    /**
     * Set model_year.
     * 
     * @param integer $model_year
     * @return void
     */
    public function setModelYear(int $model_year): void {
        $this->model_year = $model_year;
    }

    /**
     * Set list_price.
     * 
     * @param float $list_price
     * @return void
     */
    public function setListPrice(float $list_price): void {
        $this->list_price = $list_price;
    }
}
?>
