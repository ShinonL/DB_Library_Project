<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderDiscount
 *
 * @ORM\Table(name="order_discount", uniqueConstraints={@ORM\UniqueConstraint(name="order_discount_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="order_discount_discounts_Discount_ID_fk", columns={"Discount_ID"}), @ORM\Index(name="order_discount_orders_ID_fk", columns={"Order_ID"})})
 * @ORM\Entity
 */
class OrderDiscount
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
     * @var \Discounts
     *
     * @ORM\ManyToOne(targetEntity="Discounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Discount_ID", referencedColumnName="Discount_ID")
     * })
     */
    private $discount;

    /**
     * @var \Orders
     *
     * @ORM\ManyToOne(targetEntity="Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Order_ID", referencedColumnName="ID")
     * })
     */
    private $order;


}
