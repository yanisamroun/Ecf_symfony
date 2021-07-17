<?php

namespace App\Entity;

use App\Repository\GenreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GenreRepository::class)
 */
class Genre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=190)
     */
    private $Bookname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, mappedBy="genre")
     */
    private $books;

    /**
     * @ORM\ManyToMany(targetEntity=book::class, inversedBy="genres")
     */
    private $Books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
        $this->Books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookname(): ?string
    {
        return $this->Bookname;
    }

    public function setBookname(string $Bookname): self
    {
        $this->Bookname = $Bookname;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->addGenre($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            $book->removeGenre($this);
        }

        return $this;
    }
}
