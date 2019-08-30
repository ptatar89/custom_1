<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 * @ApiResource(itemOperations={"get", "put", "delete"}, collectionOperations={"get", "post"})
 */
class Customer
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
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Length(max="128")
     * @Assert\NotBlank()
     */
    protected $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="customer_id", cascade={"persist", "remove"})
     */
    protected $address;

    public function __construct()
    {
        $this->address = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @param Address $address
     */
    public function addAddress(Address $address): void
    {
        $this->address->add($address);
    }

    /**
     * @param Address $address
     */
    public function removeAddress(Address $address): void
    {
        if ($this->address->contains($address)) {
            $this->address->remove($address);
        }
    }
}