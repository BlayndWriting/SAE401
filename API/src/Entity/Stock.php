<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="stocks")
 */
class Stock {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private ?int $stock_id = null;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $product_id;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $store_id;

    /** 
     * @ORM\Column(type="integer")
     */
    private int $quantity;

    public function __toString(): string {
        return "Stock {$this->stock_id} Product:{$this->product_id} Store:{$this->store_id} Qty:{$this->quantity}\n";
    }

    /**
     * Get stock_id.
     * 
     * @return integer
     */
    public function getStockId(): ?int {
        return $this->stock_id ?? null;
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
     * Get store_id.
     * 
     * @return integer
     */
    public function getStoreId(): ?int {
        return $this->store_id ?? null;
    }

    /**
     * Get quantity.
     * 
     * @return integer
     */
    public function getQuantity(): ?int {
        return $this->quantity ?? null;
    }

    /**
     * Set stock_id.
     * 
     * @param integer $stock_id
     * 
     * @return Stock
     */
    public function setStockId(int $stock_id): void {
        $this->stock_id = $stock_id;
    }

    /**
     * Set product_id.
     * 
     * @param integer $product_id
     * 
     * @return Stock
     */
    public function setProductId(int $product_id): void {
        $this->product_id = $product_id;
    }

    /**
     * Set store_id.
     * 
     * @param integer $store_id
     * 
     * @return Stock
     */
    public function setStoreId(int $store_id): void {
        $this->store_id = $store_id;
    }

    /**
     * Set quantity.
     * 
     * @param integer $quantity
     * 
     * @return Stock
     */
    public function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
    }
}
?>
