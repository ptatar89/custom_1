<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class CustomerRepository extends EntityRepository
{
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return $this->createQueryBuilder('customer')
            ->addSelect('customer')
            ->where('customer.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}