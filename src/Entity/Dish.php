<?php

namespace App\Entity;

use App\Repository\DishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: DishRepository::class)]
class Dish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    #[Assert\Length (
        min: 2,
        max: 80,
        minMessage: 'Le nom doit comprendre au moins 2 caractères',
        maxMessage: 'Le nom doit comprendre au plus 80 caractères'
    )]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length (
        min: 10,
        max: 255,
        minMessage: 'La déscription doit comprendre au moins 10 caractères',
        maxMessage: 'La déscription doit comprendre au plus 255 caractères'
    )]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 40)]
    private ?string $category = null;

    #[ORM\ManyToMany(targetEntity: Allergen::class, inversedBy: 'dishes')]
    private Collection $allergen;

    #[ORM\OneToMany(mappedBy: 'dish', targetEntity: Photo::class)]
    private Collection $photo;

    public function __construct()
    {
        $this->allergen = new ArrayCollection();
        $this->photo = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, Allergen>
     */
    public function getAllergen(): Collection
    {
        return $this->allergen;
    }

    public function addAllergen(Allergen $allergen): self
    {
        if (!$this->allergen->contains($allergen)) {
            $this->allergen->add($allergen);
        }

        return $this;
    }

    public function removeAllergen(Allergen $allergen): self
    {
        $this->allergen->removeElement($allergen);

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhoto(): Collection
    {
        return $this->photo;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photo->contains($photo)) {
            $this->photo->add($photo);
            $photo->setDish($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photo->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getDish() === $this) {
                $photo->setDish(null);
            }
        }

        return $this;
    }
}
