<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $username = null;

    #[ORM\Column(length: 30)]
    private ?string $email = null;

    #[ORM\Column(nullable: true)]
    private ?int $nb_class = null;

    #[ORM\OneToMany(mappedBy: 'idAuthor', targetEntity: Book::class)]
    private Collection $books;

    #[ORM\Column(nullable: true)]
    private ?int $nbr_books = null;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNbClass(): ?int
    {
        return $this->nb_class;
    }

    public function setNbClass(?int $nb_class): static
    {
        $this->nb_class = $nb_class;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): static
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setIdAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): static
    {
        if ($this->books->removeElement($book)) {
            if ($book->getIdAuthor() === $this) {
                $book->setIdAuthor(null);
            }
        }

        return $this;
    }

    public function getnbrBooks(): ?int
    {
        return $this->nbr_books;
    }

    public function setnbrBooks(?int $nbr_books): static
    {
        $this->nbr_books = $nbr_books;

        return $this;
    }
}
