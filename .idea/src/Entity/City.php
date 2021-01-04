<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * City
 *
 * @ORM\Table(name="city", uniqueConstraints={@ORM\UniqueConstraint(name="city_City_ID_uindex", columns={"City_ID"})}, indexes={@ORM\Index(name="city_country_Country_ID_fk", columns={"Country_ID"})})
 * @ORM\Entity
 */
class City
{
    /**
     * @var int
     *
     * @ORM\Column(name="City_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cityId;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var \Country
     *
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Country_ID", referencedColumnName="Country_ID")
     * })
     */
    private $country;


}
