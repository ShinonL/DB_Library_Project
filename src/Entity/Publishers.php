<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publishers
 *
 * @ORM\Table(name="publishers", uniqueConstraints={@ORM\UniqueConstraint(name="publishers_Publisher_ID_uindex", columns={"Publisher_ID"})})
 * @ORM\Entity
 */
class Publishers
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


}
