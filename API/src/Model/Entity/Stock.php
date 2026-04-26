<?php

namespace SAE401\BikestoresApi\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "stocks")]
/**
 * Stock domain entity.
 */
class Stock
{
    #[ORM\Id]
    #[ORM\Column(name: "stock_id", type: "integer")]
    #[ORM\GeneratedValue]
    private int $stock_id;

    #[ORM\ManyToOne(targetEntity: Store::class)]
    #[ORM\JoinColumn(name: "store_id", referencedColumnName: "store_id", nullable: false)]
    private Store $store;

    #[ORM\ManyToOne(targetEntity: Product::class)]
    #[ORM\JoinColumn(name: "product_id", referencedColumnName: "product_id", nullable: false)]
    private Product $product;

    #[ORM\Column(name: "quantity", type: "integer")]
    private int $quantity;

    /**
     * Returns a readable string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        $res = "Stock {$this->stock_id} ";
        $res .= $this->store->getStoreId() . " ";
        $res .= $this->product->getProductId() . " ";
        $res .= $this->quantity . "\n";
        return $res;
    }

    /**
     * @param int $stock_id Stock identifier.
     *
     * @return self
     */
    public function setStockId(int $stock_id): self
    {
        $this->stock_id = $stock_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getStockId(): int
    {
        return $this->stock_id;
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
     * @param Product $product Related product.
     *
     * @return self
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param int $quantity Available quantity.
     *
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}

    /**
     * @param int $stock_id Stock identifier.
     *
     * @return self
     */
    public function setStockId(int $stock_id): self
    {
        $this->stock_id = $stock_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getStockId(): int
    {
        return $this->stock_id;
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
     * @param Product $product Related product.
     *
     * @return self
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param int $quantity Quantity.
     *
     * @return self
     */
    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}