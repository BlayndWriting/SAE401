<?php

namespace SAE401\BikestoresApi\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: "categories")]
/**
 * Category domain entity.
 */
class Category
{
    #[ORM\Id]
    #[ORM\Column(name: "category_id", type: "integer")]
    #[ORM\GeneratedValue]
    private int $category_id;

    #[ORM\Column(name: "category_name", type: "string", length: 255)]
    private string $category_name;

    /**
     * Returns a readable string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        return "Category {$this->category_id} {$this->category_name}\n";
    }

    /**
     * @param int $category_id Category identifier.
     *
     * @return self
     */
    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param string $category_name Category name.
     *
     * @return self
     */
    public function setCategoryName(string $category_name): self
    {
        $this->category_name = $category_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->category_name;
    }
}

    /**
     * @param int $category_id Category identifier.
     *
     * @return self
     */
    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->category_id;
    }

    /**
     * @param string $category_name Category name.
     *
     * @return self
     */
    public function setCategoryName(string $category_name): self
    {
        $this->category_name = $category_name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryName(): string
    {
        return $this->category_name;
    }
}