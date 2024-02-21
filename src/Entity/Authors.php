<?php

namespace App\Entity;

use App\Repository\AuthorsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorsRepository::class)]
class Authors
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $alias = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $birth_date = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $death_date = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $webpage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }

    public function getBirthDate(): ?string
    {
        return $this->birth_date;
    }

    public function setBirthDate(?string $birth_date): static
    {
        $this->birth_date = $birth_date;

        return $this;
    }

    public function getDeathDate(): ?string
    {
        return $this->death_date;
    }

    public function setDeathDate(?string $death_date): static
    {
        $this->death_date = $death_date;

        return $this;
    }

    public function getWebpage(): ?string
    {
        return $this->webpage;
    }

    public function setWebpage(?string $webpage): static
    {
        $this->webpage = $webpage;

        return $this;
    }
}
