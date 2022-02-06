<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ContentListProduct::class)]
    private $contentListProducts;

    public function __construct()
    {
        $this->contentListProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|ContentListProduct[]
     */
    public function getContentListProducts(): Collection
    {
        return $this->contentListProducts;
    }

    public function addContentListProduct(ContentListProduct $contentListProduct): self
    {
        if (!$this->contentListProducts->contains($contentListProduct)) {
            $this->contentListProducts[] = $contentListProduct;
            $contentListProduct->setProduct($this);
        }

        return $this;
    }

    public function removeContentListProduct(ContentListProduct $contentListProduct): self
    {
        if ($this->contentListProducts->removeElement($contentListProduct)) {
            // set the owning side to null (unless already changed)
            if ($contentListProduct->getProduct() === $this) {
                $contentListProduct->setProduct(null);
            }
        }

        return $this;
    }
}
