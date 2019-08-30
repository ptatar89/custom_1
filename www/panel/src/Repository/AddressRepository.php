<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class AddressRepository extends EntityRepository
{
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return $this->createQueryBuilder('address')
            ->addSelect('address')
            ->where('address.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}