<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookOrder
 *
 * @ORM\Table(name="book_order", indexes={@ORM\Index(name="book_order_book_ISBN_fk", columns={"ISBN"}), @ORM\Index(name="book_order_orders_ID_fk", columns={"Order_ID"})})
 * @ORM\Entity
 */
class BookOrder
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
     * @var int
     *
     * @ORM\Column(name="Quantity", type="integer", nullable=false, options={"default"="1"})
     */
    private $quantity = '1';

    /**
     * @var \Book
     *
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ISBN", referencedColumnName="ISBN")
     * })
     */
    private $isbn;

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
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return Book
     */
    public function getIsbn(): Book
    {
        return $this->isbn;
    }

    /**
     * @param Book $isbn
     */
    public function setIsbn(Book $isbn): void
    {
        $this->isbn = $isbn;
    }

    /**
     * @return Orders
     */
    public function getOrder(): Orders
    {
        return $this->order;
    }

    /**
     * @param Orders $order
     */
    public function setOrder(Orders $order): void
    {
        $this->order = $order;
    }


}
