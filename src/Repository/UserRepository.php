<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class UserRepository extends EntityRepository
{
    public function findUserWithEmailAndUsername($username, $email)
    {
        return $this->createQueryBuilder('user')
            ->andWhere('user.username = :username')
            ->andWhere('user.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }
}