<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publisher
 *
 * @ORM\Table(name="publisher", uniqueConstraints={@ORM\UniqueConstraint(name="publishers_Publisher_ID_uindex", columns={"Publisher_ID"})})
 * @ORM\Entity
 */
class Publisher
{
    /**
     * @var int
     *
     * @ORM\Column(name="Publisher_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $publisherId;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @return int
     */
    public function getPublisherId(): int
    {
        return $this->publisherId;
    }

    /**
     * @param int $publisherId
     */
    public function setPublisherId(int $publisherId): void
    {
        $this->publisherId = $publisherId;
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
