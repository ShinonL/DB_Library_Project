<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Languages
 *
 * @ORM\Table(name="languages", uniqueConstraints={@ORM\UniqueConstraint(name="languages_Language_ID_uindex", columns={"Language_ID"})})
 * @ORM\Entity
 */
class Languages
{
    /**
     * @var int
     *
     * @ORM\Column(name="Language_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $languageId;

    /**
     * @var string
     *
     * @ORM\Column(name="Language_Name", type="string", length=100, nullable=false)
     */
    private $languageName;


}
