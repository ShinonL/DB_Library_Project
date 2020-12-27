<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Shippingcompany
 *
 * @ORM\Table(name="shippingcompany", uniqueConstraints={@ORM\UniqueConstraint(name="ShippingCompany_Phone_uindex", columns={"Phone"}), @ORM\UniqueConstraint(name="ShippingCompany_Ship_ID_uindex", columns={"Ship_ID"}), @ORM\UniqueConstraint(name="ShippingCompany_Email_uindex", columns={"Email"})})
 * @ORM\Entity
 */
class Shippingcompany
{
    /**
     * @var int
     *
     * @ORM\Column(name="Ship_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $shipId;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Phone", type="string", length=11, nullable=false)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=255, nullable=false)
     */
    private $email;


}
