<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookOrder
 *
 * @ORM\Table(name="book_order", uniqueConstraints={@ORM\UniqueConstraint(name="book_order_ID_uindex", columns={"ID"})}, indexes={@ORM\Index(name="book_order_book_ISBN_fk", columns={"ISBN"}), @ORM\Index(name="book_order_orders_ID_fk", columns={"Order_ID"})})
 * @ORM\Entity
 */
class BookOrder
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


}
