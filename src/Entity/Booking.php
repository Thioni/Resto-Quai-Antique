<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]    
    #[Assert\Length (
        min: 2,
        max: 20,
        minMessage: 'Le prénom doit comporter au moins 2 caractères',
        maxMessage: 'Le prénom doit comporter au maximum 20 caractères'
    )]
    private ?string $firstname = null;

    #[ORM\Column(length: 20)]
    #[Assert\Length (
        min: 2,
        max: 20,
        minMessage: 'Le nom doit comporter au moins 2 caractères',
        maxMessage: 'Le nom doit comporter au maximum 20 caractères'
    )]
    private ?string $lastname = null;

    #[ORM\Column(length: 254)]
    #[Assert\Email(
        message: 'L\'adresse {{ value }} n\'est pas une adresse valide.',
    )]
    private ?string $email = null;

    #[ORM\Column]
    #[Assert\GreaterThan(
        0,
        message: 'Le nombre de places doit au minimum être égale à 1',
    )]
    #[Assert\LessThanOrEqual(
        15,
        message: 'Le nombre de places doit au maximum être égale à 15',
    )]
    private ?int $seats = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\GreaterThan(
        'now',
        message: 'La date doit être postérieure ou égale à la date actuelle.',
    )]
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
