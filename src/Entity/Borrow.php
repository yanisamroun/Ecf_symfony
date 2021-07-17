<?php

namespace App\Entity;

use App\Repository\BorrowRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BorrowRepository::class)
 */
class Borrow
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $borrow_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $back_date;

    /**
     * @ORM\ManyToOne(targetEntity=Book::class, inversedBy="borrows")
     */
    private $book;

    /**
     * @ORM\ManyToOne(targetEntity=borrower::class, inversedBy="borrows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Borrower;

    /**
     * @ORM\ManyToOne(targetEntity=book::class, inversedBy="Books")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Book;

    /**
     * @ORM\ManyToOne(targetEntity=Borrower::class, inversedBy="Borrows")
     * @ORM\JoinColumn(nullable=false)
     */
    private $borrower;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowDate(): ?\DateTimeInterface
    {
        return $this->borrow_date;
    }

    public function setBorrowDate(\DateTimeInterface $borrow_date): self
    {
        $this->borrow_date = $borrow_date;

        return $this;
    }

    public function getBackDate(): ?\DateTimeInterface
    {
        return $this->back_date;
    }

    public function setBackDate(?\DateTimeInterface $back_date): self
    {
        $this->back_date = $back_date;

        return $this;
    }

    public function getBook(): ?Book
    {
        return $this->book;
    }

    public function setBook(?Book $book): self
    {
        $this->book = $book;

        return $this;
    }

    public function getBorrower(): ?borrower
    {
        return $this->Borrower;
    }

    public function setBorrower(?borrower $Borrower): self
    {
        $this->Borrower = $Borrower;

        return $this;
    }
}
