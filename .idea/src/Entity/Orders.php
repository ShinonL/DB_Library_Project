<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders", uniqueConstraints={@ORM\UniqueConstraint(name="orders_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="orders_shippingcompany_Ship_ID_fk", columns={"Ship_ID"}), @ORM\Index(name="orders_user_username_fk", columns={"username"})})
 * @ORM\Entity
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
     * @var \DateTime
     *
     * @ORM\Column(name="OrderDate", type="date", nullable=false)
     */
    private $orderdate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="ShippedDate", type="date", nullable=true, options={"default"="NULL"})
     */
    private $shippeddate = 'NULL';

    /**
     * @var \Shippingcompany
     *
     * @ORM\ManyToOne(targetEntity="Shippingcompany")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ship_ID", referencedColumnName="Ship_ID")
     * })
     */
    private $ship;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="username", referencedColumnName="username")
     * })
     */
    private $username;


}
