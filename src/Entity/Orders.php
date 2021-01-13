<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", uniqueConstraints={@ORM\UniqueConstraint(name="orders_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="orders_shipping_company_Ship_ID_fk", columns={"Ship_ID"})})
 * @ORM\Entity
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="Order_Date", type="string", length=11, nullable=false)
     */
    private $orderDate;

    /**
     * @var \ShippingCompany
     *
     * @ORM\ManyToOne(targetEntity="ShippingCompany")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ship_ID", referencedColumnName="Ship_ID")
     * })
     */
    private $ship;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getOrderDate(): string
    {
        return $this->orderDate;
    }

    /**
     * @param string $orderDate
     */
    public function setOrderDate(string $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return ShippingCompany
     */
    public function getShip(): ShippingCompany
    {
        return $this->ship;
    }

    /**
     * @param ShippingCompany $ship
     */
    public function setShip(ShippingCompany $ship): void
    {
        $this->ship = $ship;
    }


}
