<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review", uniqueConstraints={@ORM\UniqueConstraint(name="review_Review_ID_uindex", columns={"Review_ID"})}, indexes={@ORM\Index(name="review_book_ISBN_fk", columns={"ISBN"}), @ORM\Index(name="review_user_username_fk", columns={"Username"})})
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
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
     *   @ORM\JoinColumn(name="Username", referencedColumnName="Username")
     * })
     */
    private $username;

    /**
     * @return int
     */
    public function getReviewId(): int
    {
        return $this->reviewId;
    }

    /**
     * @param int $reviewId
     */
    public function setReviewId(int $reviewId): void
    {
        $this->reviewId = $reviewId;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return string|null
     */
    public function getReviewText(): ?string
    {
        return $this->reviewText;
    }

    /**
     * @param string|null $reviewText
     */
    public function setReviewText(?string $reviewText): void
    {
        $this->reviewText = $reviewText;
    }

    /**
     * @return \DateTime
     */
    public function getPostDate(): \DateTime
    {
        return $this->postDate;
    }

    /**
     * @param \DateTime $postDate
     */
    public function setPostDate(\DateTime $postDate): void
    {
        $this->postDate = $postDate;
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

    /**
     * @return \User
     */
    public function getUsername(): \User
    {
        return $this->username;
    }

    /**
     * @param \User $username
     */
    public function setUsername(\User $username): void
    {
        $this->username = $username;
    }


}
