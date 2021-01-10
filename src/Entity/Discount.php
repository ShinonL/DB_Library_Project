<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discount
 *
 * @ORM\Table(name="discount", uniqueConstraints={@ORM\UniqueConstraint(name="discounts_Discount_ID_uindex", columns={"Discount_ID"})})
 * @ORM\Entity
 */
class Discount
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

    /**
     * @return string
     */
    public function getDiscountId(): string
    {
        return $this->discountId;
    }

    /**
     * @param string $discountId
     */
    public function setDiscountId(string $discountId): void
    {
        $this->discountId = $discountId;
    }

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value): void
    {
        $this->value = $value;
    }


}
