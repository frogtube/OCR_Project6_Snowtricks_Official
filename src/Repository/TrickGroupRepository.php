<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class TrickGroupRepository extends EntityRepository
{
    public function getTrickGroupsAlphabetically()
    {
        return $this->createQueryBuilder('trickGroup')
            ->orderBy('trickGroup.group', 'ASC');
    }
}