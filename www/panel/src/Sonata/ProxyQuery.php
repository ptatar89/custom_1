<?php

namespace App\Sonata;

use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery as SonataProxyQuery;
use Doctrine\ORM\QueryBuilder;

class ProxyQuery extends SonataProxyQuery
{
    protected function getFixedQueryBuilder(QueryBuilder $queryBuilder)
    {
        return $queryBuilder;
    }
}