<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity('email', 'Un compte utilise déja cette adresse mail.')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Assert\Email(
        message: 'L\'adresse {{ value }} n\'est pas une adresse valide.',
      )]
    private ?string $email = null;

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
        minMessage: 'Le nom de famille doit comporter au moins 2 caractères',
        maxMessage: 'Le nom de famille doit comporter au maximum 20 caractères'
      )]
    private ?string $lastname = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Regex(
        pattern: "$(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[\W]).{8,64}$",
        match: true,
        message: 'Le mot de passe doit inclure au minimum huit caractères dont au moins une majuscule, une minuscule, un chiffre et un caractère spécial.',
      )]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Allergen::class, inversedBy: 'users')]
    private Collection $allergy;

    public function __construct()
    {
        $this->allergy = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
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
    
    /**
     * @return Collection<int, Allergen>
     */
    public function getAllergy(): Collection
    {
        return $this->allergy;
    }

    public function addAllergy(Allergen $allergy): self
    {
        if (!$this->allergy->contains($allergy)) {
            $this->allergy->add($allergy);
        }

        return $this;
    }

    public function removeAllergy(Allergen $allergy): self
    {
        $this->allergy->removeElement($allergy);

        return $this;
    }
    
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        
        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

}
