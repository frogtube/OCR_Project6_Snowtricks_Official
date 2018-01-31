<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class UserRepository extends EntityRepository
{
    /* NOT USED
    public function countExistingUsers($username)
    {
        return $this->createQueryBuilder('user')
            ->andwhere('user.username = :username')
            ->setParameter('username', $username)
            ->select('COUNT(user)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    */
}