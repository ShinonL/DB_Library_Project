<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShippingCompany
 *
 * @ORM\Table(name="shipping_company", uniqueConstraints={@ORM\UniqueConstraint(name="ShippingCompany_Phone_uindex", columns={"Phone"}), @ORM\UniqueConstraint(name="ShippingCompany_Ship_ID_uindex", columns={"Ship_ID"}), @ORM\UniqueConstraint(name="ShippingCompany_Email_uindex", columns={"Email"})})
 * @ORM\Entity(repositoryClass="App\Repository\ShippingCompanyRepository")
 */
class ShippingCompany
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

    /**
     * @return int
     */
    public function getShipId(): int
    {
        return $this->shipId;
    }

    /**
     * @param int $shipId
     */
    public function setShipId(int $shipId): void
    {
        $this->shipId = $shipId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


}
