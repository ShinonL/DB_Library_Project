<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookAuthor
 *
 * @ORM\Table(name="book_author", indexes={@ORM\Index(name="book_authors_book_ISBN_fk", columns={"ISBN"}), @ORM\Index(name="book_authors_author_ID_fk", columns={"Author_ID"})})
 * @ORM\Entity(repositoryClass="App\Repository\BookAuthorRepository")
 */
class BookAuthor
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Author
     *
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Author_ID", referencedColumnName="ID")
     * })
     */
    private $author;

    /**
     * @var \Book
     *
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ISBN", referencedColumnName="ISBN")
     * })
     */
    private $isbn;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return \Author
     */
    public function getAuthor(): \Author
    {
        return $this->author;
    }

    /**
     * @param \Author $author
     */
    public function setAuthor(\Author $author): void
    {
        $this->author = $author;
    }

    /**
     * @return \Book
     */
    public function getIsbn(): \Book
    {
        return $this->isbn;
    }

    /**
     * @param \Book $isbn
     */
    public function setIsbn(\Book $isbn): void
    {
        $this->isbn = $isbn;
    }


}
