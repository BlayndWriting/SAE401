<?php

namespace SAE401\BikestoresApi\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "products")]
/**
 * Product domain entity.
 */
class Product
{
    #[ORM\Id]
    #[ORM\Column(name: "product_id", type: "integer")]
    #[ORM\GeneratedValue]
    private int $product_id;

    #[ORM\Column(name: "product_name", type: "string", length: 255)]
    private string $product_name;

    #[ORM\ManyToOne(targetEntity: Brand::class)]
    #[ORM\JoinColumn(name: "brand_id", referencedColumnName: "brand_id", nullable: false)]
    private Brand $brand;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: "category_id", referencedColumnName: "category_id", nullable: false)]
    private Category $category;

    #[ORM\Column(name: "model_year", type: "smallint")]
    private int $model_year;

    #[ORM\Column(name: "list_price", type: "decimal", precision: 10, scale: 2)]
    private string $list_price;

    /**
     * Returns a readable string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        $res = "Product {$this->product_id} {$this->product_name} ";
        $res .= $this->brand->getBrandId() . " ";
        $res .= $this->category->getCategoryId() . " ";
        $res .= $this->model_year . " ";
        $res .= $this->list_price . "\n";
        return $res;
    }

    /**
     * @param int $product_id Product identifier.
     *
     * @return self
     */
    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param string $product_name Product name.
     *
     * @return self
     */
    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->product_name;
    }

    /**
     * @param Brand $brand Related brand.
     *
     * @return self
     */
    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Category $category Related category.
     *
     * @return self
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param int $model_year Product model year.
     *
     * @return self
     */
    public function setModelYear(int $model_year): self
    {
        $this->model_year = $model_year;
        return $this;
    }

    /**
     * @return int
     */
    public function getModelYear(): int
    {
        return $this->model_year;
    }

    /**
     * @param string $list_price Product listed price.
     *
     * @return self
     */
    public function setListPrice(string $list_price): self
    {
        $this->list_price = $list_price;
        return $this;
    }

    /**
     * @return string
     */
    public function getListPrice(): string
    {
        return $this->list_price;
    }
}

    /**
     * @param int $product_id Product identifier.
     *
     * @return self
     */
    public function setProductId(int $product_id): self
    {
        $this->product_id = $product_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @param string $product_name Product name.
     *
     * @return self
     */
    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->product_name;
    }

    /**
     * @param Brand $brand Brand.
     *
     * @return self
     */
    public function setBrand(Brand $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    /**
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

    /**
     * @param Category $category Category.
     *
     * @return self
     */
    public function setCategory(Category $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param int $model_year Model year.
     *
     * @return self
     */
    public function setModelYear(int $model_year): self
    {
        $this->model_year = $model_year;
        return $this;
    }

    /**
     * @return int
     */
    public function getModelYear(): int
    {
        return $this->model_year;
    }

    /**
     * @param string $list_price List price.
     *
     * @return self
     */
    public function setListPrice(string $list_price): self
    {
        $this->list_price = $list_price;
        return $this;
    }

    /**
     * @return string
     */
    public function getListPrice(): string
    {
        return $this->list_price;
    }
}