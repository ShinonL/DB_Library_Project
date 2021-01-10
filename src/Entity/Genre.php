<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre", uniqueConstraints={@ORM\UniqueConstraint(name="genre_Genre_ID_uindex", columns={"Genre_ID"})})
 * @ORM\Entity
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="Genre_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $genreId;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getGenreId(): int
    {
        return $this->genreId;
    }

    /**
     * @param int $genreId
     */
    public function setGenreId(int $genreId): void
    {
        $this->genreId = $genreId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}
