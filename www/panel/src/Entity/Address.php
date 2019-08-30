<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Circle\DoctrineRestDriver\Annotations as DataSource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 * @ORM\Table(name="addresses")
 * @DataSource\Select("http://api.local/api/addresses/{id}", method="GET")
 * @DataSource\Fetch("http://api.local/api/customers/{id}/addresses", method="GET")
 * @DataSource\Insert("http://api.local/api/addresses", method="POST", statusCodes={201})
 * @DataSource\Update("http://api.local/api/addresses/{id}", method="PUT")
 * @DataSource\Delete("http://api.local/api/addresses/{id}", method="DELETE", statusCodes={200})
 */
class Address implements \ArrayAccess
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Length(max="128")
     * @Assert\NotBlank()
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\NotBlank()
     */
    protected $flat_number;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Length(max="128")
     * @Assert\NotBlank()
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=64)
     * @Assert\Length(max="64")
     * @Assert\NotBlank()
     */
    protected $zip;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer", inversedBy="address")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     * @Assert\NotNull()
     */
    protected $customer_id;

    protected $customer;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getFlatNumber(): ?string
    {
        return $this->flat_number;
    }

    /**
     * @param int $flatNumber
     */
    public function setFlatNumber(string $flatNumber): void
    {
        $this->flat_number = $flatNumber;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     */
    public function setZip(string $zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }

    /**
     * @param mixed $customer_id
     */
    public function setCustomerId($customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    public function __toString()
    {
        return $this->street;
    }

    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}