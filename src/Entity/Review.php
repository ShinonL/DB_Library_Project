<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review", uniqueConstraints={@ORM\UniqueConstraint(name="review_Review_ID_uindex", columns={"Review_ID"})}, indexes={@ORM\Index(name="review_user_username_fk", columns={"username"}), @ORM\Index(name="review_book_ISBN_fk", columns={"ISBN"})})
 * @ORM\Entity
 */
class Review
{
    /**
     * @var int
     *
     * @ORM\Column(name="Review_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $reviewId;

    /**
     * @var int
     *
     * @ORM\Column(name="Rating", type="integer", nullable=false)
     */
    private $rating;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Review_Text", type="text", length=0, nullable=true, options={"default"="NULL"})
     */
    private $reviewText = 'NULL';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Post_Date", type="date", nullable=false)
     */
    private $postDate;

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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="username", referencedColumnName="username")
     * })
     */
    private $username;


}
