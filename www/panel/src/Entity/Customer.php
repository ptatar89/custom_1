<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Circle\DoctrineRestDriver\Annotations as DataSource;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ORM\Table(name="customers")
 * @DataSource\Select("http://api.local/api/customers/{id}", method="GET")
 * @DataSource\Fetch("http://api.local/api/customers", method="GET")
 * @DataSource\Insert("http://api.local/api/customers", method="POST", statusCodes={201})
 * @DataSource\Update("http://api.local/api/customers/{id}", method="PUT")
 * @DataSource\Delete("http://api.local/api/customers/{id}", method="DELETE", statusCodes={200})
 * @ORM\SqlResultSetMappings()
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", name="id")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Length(max="128")
     * @Assert\NotBlank()
     */
    protected $first_name;

    /**
     * @ORM\Column(type="string", length=128)
     * @Assert\Length(max="128")
     * @Assert\NotBlank()
     */
    protected $last_name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Address", mappedBy="customer_id", cascade={"persist"})
     */
    protected $address;

    public function __construct()
    {
        $this->address = new ArrayCollection();
    }

    public function fromData(array $data): self
    {
        $customer = new self();
        $customer->setId($data['id']);
        $customer->setFirstName($data['firstName']);
        $customer->setLastName($data['lastName']);

        return $customer;
    }

    /**
     * @return int
     */
    public function getId(): int
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
     * @return int|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->first_name = $firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->last_name = $lastName;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function addAddres($address): void
    {
        if (null === $this->address) {
            $this->address = new ArrayCollection();
        }
        $this->address->add($address);
    }

    /**
     * @param Address $address
     */
    public function removeAddres($address): void
    {
        if ($this->address->contains($address)) {
            $this->address->remove($address);
        }
    }

    public function __toString()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}