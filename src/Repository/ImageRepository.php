<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr;

class ImageRepository extends EntityRepository
{
    public function getImageByUser($user)
    {
        return $this->createQueryBuilder('image')
            ->andwhere('image.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getOneOrNullResult();
    }
}