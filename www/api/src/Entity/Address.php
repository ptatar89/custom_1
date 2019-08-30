<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Kernel;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 * @ApiResource(itemOperations={"get", "put", "delete"}, collectionOperations={"get", "post"})
 * @ApiFilter(SearchFilter::class, properties={"customer_id": "exact"})
 */
class Address
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
     * @Assert\Length(max="128")
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
     * @ORM\Column(type="integer", length=64)
     * @Assert\NotNull()
     */
    protected $customer_id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getFlatNumber(): ?string
    {
        return $this->flat_number;
    }

    /**
     * @param string $flatNumber
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
     * @param mixed $customer_id
     */
    public function setCustomerId($customer_id): void
    {
        $this->customer_id = $customer_id;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customer_id;
    }
}