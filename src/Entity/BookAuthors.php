<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookAuthors
 *
 * @ORM\Table(name="book_authors", uniqueConstraints={@ORM\UniqueConstraint(name="book_authors_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="book_authors_author_ID_fk", columns={"Author_ID"}), @ORM\Index(name="book_authors_book_ISBN_fk", columns={"ISBN"})})
 * @ORM\Entity
 */
class BookAuthors
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


}
