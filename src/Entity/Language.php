<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Language
 *
 * @ORM\Table(name="language", uniqueConstraints={@ORM\UniqueConstraint(name="languages_Language_ID_uindex", columns={"Language_ID"})})
 * @ORM\Entity
 */
class Language
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

    /**
     * @return int
     */
    public function getLanguageId(): int
    {
        return $this->languageId;
    }

    /**
     * @param int $languageId
     */
    public function setLanguageId(int $languageId): void
    {
        $this->languageId = $languageId;
    }

    /**
     * @return string
     */
    public function getLanguageName(): string
    {
        return $this->languageName;
    }

    /**
     * @param string $languageName
     */
    public function setLanguageName(string $languageName): void
    {
        $this->languageName = $languageName;
    }


}
