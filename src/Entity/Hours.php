<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoursRepository::class)]
class Hours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $monday_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $monday_close = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tuesday_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $tuesday_close = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $wednesday_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $wednesday_close = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $thursday_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $thursday_close = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $friday_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $friday_close = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $saturday_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $saturday_close = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sunday_open = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $sunday_close = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMondayOpen(): ?\DateTimeInterface
    {
        return $this->monday_open;
    }

    public function setMondayOpen(?\DateTimeInterface $monday_open): self
    {
        $this->monday_open = $monday_open;

        return $this;
    }

    public function getMondayClose(): ?\DateTimeInterface
    {
        return $this->monday_close;
    }

    public function setMondayClose(?\DateTimeInterface $monday_close): self
    {
        $this->monday_close = $monday_close;

        return $this;
    }

    public function getTuesdayOpen(): ?\DateTimeInterface
    {
        return $this->tuesday_open;
    }

    public function setTuesdayOpen(?\DateTimeInterface $tuesday_open): self
    {
        $this->tuesday_open = $tuesday_open;

        return $this;
    }

    public function getTuesdayClose(): ?\DateTimeInterface
    {
        return $this->tuesday_close;
    }

    public function setTuesdayClose(?\DateTimeInterface $tuesday_close): self
    {
        $this->tuesday_close = $tuesday_close;

        return $this;
    }

    public function getWednesdayOpen(): ?\DateTimeInterface
    {
        return $this->wednesday_open;
    }

    public function setWednesdayOpen(?\DateTimeInterface $wednesday_open): self
    {
        $this->wednesday_open = $wednesday_open;

        return $this;
    }

    public function getWednesdayClose(): ?\DateTimeInterface
    {
        return $this->wednesday_close;
    }

    public function setWednesdayClose(?\DateTimeInterface $wednesday_close): self
    {
        $this->wednesday_close = $wednesday_close;

        return $this;
    }

    public function getThursdayOpen(): ?\DateTimeInterface
    {
        return $this->thursday_open;
    }

    public function setThursdayOpen(?\DateTimeInterface $thursday_open): self
    {
        $this->thursday_open = $thursday_open;

        return $this;
    }

    public function getThursdayClose(): ?\DateTimeInterface
    {
        return $this->thursday_close;
    }

    public function setThursdayClose(?\DateTimeInterface $thursday_close): self
    {
        $this->thursday_close = $thursday_close;

        return $this;
    }

    public function getFridayOpen(): ?\DateTimeInterface
    {
        return $this->friday_open;
    }

    public function setFridayOpen(?\DateTimeInterface $friday_open): self
    {
        $this->friday_open = $friday_open;

        return $this;
    }

    public function getFridayClose(): ?\DateTimeInterface
    {
        return $this->friday_close;
    }

    public function setFridayClose(?\DateTimeInterface $friday_close): self
    {
        $this->friday_close = $friday_close;

        return $this;
    }

    public function getSaturdayOpen(): ?\DateTimeInterface
    {
        return $this->saturday_open;
    }

    public function setSaturdayOpen(?\DateTimeInterface $saturday_open): self
    {
        $this->saturday_open = $saturday_open;

        return $this;
    }

    public function getSaturdayClose(): ?\DateTimeInterface
    {
        return $this->saturday_close;
    }

    public function setSaturdayClose(?\DateTimeInterface $saturday_close): self
    {
        $this->saturday_close = $saturday_close;

        return $this;
    }

    public function getSundayOpen(): ?\DateTimeInterface
    {
        return $this->sunday_open;
    }

    public function setSundayOpen(?\DateTimeInterface $sunday_open): self
    {
        $this->sunday_open = $sunday_open;

        return $this;
    }

    public function getSundayClose(): ?\DateTimeInterface
    {
        return $this->sunday_close;
    }

    public function setSundayClose(?\DateTimeInterface $sunday_close): self
    {
        $this->sunday_close = $sunday_close;

        return $this;
    }
}
