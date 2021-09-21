<?php

namespace App\Entity;

use App\Repository\SliderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SliderRepository::class)
 */
class Slider
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tilte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $minidesc;

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

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getTilte(): ?string
    {
        return $this->tilte;
    }

    public function setTilte(string $tilte): self
    {
        $this->tilte = $tilte;

        return $this;
    }

    public function getMinidesc(): ?string
    {
        return $this->minidesc;
    }

    public function setMinidesc(?string $minidesc): self
    {
        $this->minidesc = $minidesc;

        return $this;
    }
}
