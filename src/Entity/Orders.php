<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", uniqueConstraints={@ORM\UniqueConstraint(name="orders_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="orders_shipping_company_Ship_ID_fk", columns={"Ship_ID"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Username", type="string", length=255, nullable=false)
     */
    private $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Order_Date", type="date", nullable=false)
     */
    private $orderDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="Shipped_Date", type="date", nullable=true, options={"default"="NULL"})
     */
    private $shippedDate = 'NULL';

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
     * @return \DateTime
     */
    public function getOrderDate(): \DateTime
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime $orderDate
     */
    public function setOrderDate(\DateTime $orderDate): void
    {
        $this->orderDate = $orderDate;
    }

    /**
     * @return \DateTime|null
     */
    public function getShippedDate()
    {
        return $this->shippedDate;
    }

    /**
     * @param \DateTime|null $shippedDate
     */
    public function setShippedDate($shippedDate): void
    {
        $this->shippedDate = $shippedDate;
    }

    /**
     * @return \ShippingCompany
     */
    public function getShip(): \ShippingCompany
    {
        return $this->ship;
    }

    /**
     * @param \ShippingCompany $ship
     */
    public function setShip(\ShippingCompany $ship): void
    {
        $this->ship = $ship;
    }


}
