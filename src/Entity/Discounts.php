<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discounts
 *
 * @ORM\Table(name="discounts", uniqueConstraints={@ORM\UniqueConstraint(name="discounts_Discount_ID_uindex", columns={"Discount_ID"})})
 * @ORM\Entity
 */
class Discounts
{
    /**
     * @var string
     *
     * @ORM\Column(name="Discount_ID", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $discountId;

    /**
     * @var float
     *
     * @ORM\Column(name="Value", type="float", precision=10, scale=0, nullable=false)
     */
    private $value = '0';


}
