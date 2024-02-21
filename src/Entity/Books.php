<?php

namespace App\Entity;

use App\Repository\BooksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BooksRepository::class)]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?authors $author = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $language = null;

    #[ORM\Column(nullable: true)]
    private ?array $bookshelves = null;

    #[ORM\Column(nullable: true)]
    private ?array $subjects = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?authors
    {
        return $this->author;
    }

    public function setAuthor(?authors $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $string): static
    {
        $this->name = $string;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getBookshelves(): ?array
    {
        return $this->bookshelves;
    }

    public function setBookshelves(?array $bokkshelves): static
    {
        $this->bookshelves = $bokkshelves;

        return $this;
    }

    public function getSubjects(): ?array
    {
        return $this->subjects;
    }

    public function setSubjects(?array $subjects): static
    {
        $this->subjects = $subjects;

        return $this;
    }
}
