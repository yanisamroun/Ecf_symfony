<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
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
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $annee_edition;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombre_pages;

    /**
     * @ORM\Column(type="string", length=190, nullable=true)
     */
    private $code_isbn;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Author;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, inversedBy="books")
     */
    private $genre;

    /**
     * @ORM\OneToMany(targetEntity=Borrow::class, mappedBy="book")
     */
    private $borrows;

    /**
     * @ORM\ManyToMany(targetEntity=Author::class, mappedBy="Books")
     */
    private $authors;

    /**
     * @ORM\ManyToMany(targetEntity=Genre::class, mappedBy="Books")
     */
    private $genres;

    /**
     * @ORM\OneToMany(targetEntity=Borrow::class, mappedBy="Book")
     */
    private $Books;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->borrows = new ArrayCollection();
        $this->authors = new ArrayCollection();
        $this->genres = new ArrayCollection();
        $this->Books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAnneeEdition(): ?int
    {
        return $this->annee_edition;
    }

    public function setAnneeEdition(?int $annee_edition): self
    {
        $this->annee_edition = $annee_edition;

        return $this;
    }

    public function getNombrePages(): ?int
    {
        return $this->nombre_pages;
    }

    public function setNombrePages(int $nombre_pages): self
    {
        $this->nombre_pages = $nombre_pages;

        return $this;
    }

    public function getCodeIsbn(): ?string
    {
        return $this->code_isbn;
    }

    public function setCodeIsbn(?string $code_isbn): self
    {
        $this->code_isbn = $code_isbn;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->Author;
    }

    public function setAuthor(?Author $Author): self
    {
        $this->Author = $Author;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenre(): Collection
    {
        return $this->genre;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genre->contains($genre)) {
            $this->genre[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genre->removeElement($genre);

        return $this;
    }

    /**
     * @return Collection|Borrow[]
     */
    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrow $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setBook($this);
        }

        return $this;
    }

    public function removeBorrow(Borrow $borrow): self
    {
        if ($this->borrows->removeElement($borrow)) {
            // set the owning side to null (unless already changed)
            if ($borrow->getBook() === $this) {
                $borrow->setBook(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Author[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
            $author->addBook($this);
        }

        return $this;
    }

    public function removeAuthor(Author $author): self
    {
        if ($this->authors->removeElement($author)) {
            $author->removeBook($this);
        }

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    /**
     * @return Collection|Borrow[]
     */
    public function getBooks(): Collection
    {
        return $this->Books;
    }

    public function addBook(Borrow $book): self
    {
        if (!$this->Books->contains($book)) {
            $this->Books[] = $book;
            $book->setBook($this);
        }

        return $this;
    }

    public function removeBook(Borrow $book): self
    {
        if ($this->Books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getBook() === $this) {
                $book->setBook(null);
            }
        }

        return $this;
    }
}
