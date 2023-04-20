<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $firstname = null;

    #[ORM\Column(length: 20)]
    private ?string $lastname = null;

    #[ORM\Column(length: 254)]
    private ?string $email = null;

    #[ORM\Column]
    private ?int $seats = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $timeslot = null;

    #[ORM\ManyToMany(targetEntity: allergen::class, inversedBy: 'bookings')]
    private Collection $allergy;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $comment = null;

    public function __construct()
    {
        $this->allergy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSeats(): ?int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): self
    {
        $this->seats = $seats;

        return $this;
    }

    public function getTimeslot(): ?\DateTimeInterface
    {
        return $this->timeslot;
    }

    public function setTimeslot(\DateTimeInterface $timeslot): self
    {
        $this->timeslot = $timeslot;

        return $this;
    }

    /**
     * @return Collection<int, allergen>
     */
    public function getAllergy(): Collection
    {
        return $this->allergy;
    }

    public function addAllergy(allergen $allergy): self
    {
        if (!$this->allergy->contains($allergy)) {
            $this->allergy->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(allergen $allergy): self
    {
        $this->allergy->removeElement($allergy);

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
