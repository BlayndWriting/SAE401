<?php
namespace Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category {
    /** 
     * @ORM\id
     * @ORM\Column(type="integer")
     * @ORM\GenerateId
     */
    private int $category_id;

    /** 
     * @ORM\Column(type="string")
     */
    private string $category_name;

    public function __tostring(): string {
        return "Category {$this->category_id} {$this->category_name}\n";
    }

    /**
     * Get category_id.
     * 
     * @return integer
     */
    public function getCategoryId($category_id): ?int {
        return $this->category_id;
    }

    /**
     * Get category_name.
     * 
     * @return string
     */
    public function getCategoryName($category_name): ?string {
        return $this->category_name;
    }

    /**
     * Set category_id.
     * 
     * @param integer $category_id
     * 
     * @return Category
     */
    public function setCategoryId(int $category_id): void {
        $this->category_id = $category_id;
    }

    /**
     * Set category_name.
     * 
     * @param string $category_name
     * 
     * @return Category
     */
    public function setCategoryName(string $category_name): void {
        $this->category_name = $category_name;
    }
}
?>