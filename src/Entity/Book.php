<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book", uniqueConstraints={@ORM\UniqueConstraint(name="book_ISBN_uindex", columns={"ISBN"})}, indexes={@ORM\Index(name="book_languages_Language_ID_fk", columns={"Language_ID"}), @ORM\Index(name="book_publishers_Publisher_ID_fk", columns={"Publisher_ID"})})
 * @ORM\Entity
 */
class Book
{
    /**
     * @var string
     *
     * @ORM\Column(name="ISBN", type="string", length=100, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $isbn;

    /**
     * @var string
     *
     * @ORM\Column(name="Title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Publish_Date", type="date", nullable=false)
     */
    private $publishDate;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer", nullable=false)
     */
    private $quantity = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="Price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Cover_Image", type="blob", length=0, nullable=true, options={"default"="NULL"})
     */
    private $coverImage = 'NULL';

    /**
     * @var \Languages
     *
     * @ORM\ManyToOne(targetEntity="Languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Language_ID", referencedColumnName="Language_ID")
     * })
     */
    private $language;

    /**
     * @var \Publishers
     *
     * @ORM\ManyToOne(targetEntity="Publishers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Publisher_ID", referencedColumnName="Publisher_ID")
     * })
     */
    private $publisher;


}
