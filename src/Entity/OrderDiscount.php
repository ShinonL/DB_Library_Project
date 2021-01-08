<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderDiscount
 *
 * @ORM\Table(name="order_discount", indexes={@ORM\Index(name="order_discount_orders_ID_fk", columns={"Order_ID"}), @ORM\Index(name="order_discount_discounts_Discount_ID_fk", columns={"Discount_ID"})})
 * @ORM\Entity(repositoryClass="App\Repository\OrderDiscountRepository")
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
     * @var \Discount
     *
     * @ORM\ManyToOne(targetEntity="Discount")
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
     * @return \Discount
     */
    public function getDiscount(): \Discount
    {
        return $this->discount;
    }

    /**
     * @param \Discount $discount
     */
    public function setDiscount(\Discount $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return \Orders
     */
    public function getOrder(): \Orders
    {
        return $this->order;
    }

    /**
     * @param \Orders $order
     */
    public function setOrder(\Orders $order): void
    {
        $this->order = $order;
    }


}
