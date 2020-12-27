<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookGenre
 *
 * @ORM\Table(name="book_genre", uniqueConstraints={@ORM\UniqueConstraint(name="book_genre_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="book_genre_book_ISBN_fk", columns={"ISBN"}), @ORM\Index(name="book_genre_genre_Genre_ID_fk", columns={"Genre_ID"})})
 * @ORM\Entity
 */
class BookGenre
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
     * @var \Book
     *
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ISBN", referencedColumnName="ISBN")
     * })
     */
    private $isbn;

    /**
     * @var \Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Genre_ID", referencedColumnName="Genre_ID")
     * })
     */
    private $genre;


}
