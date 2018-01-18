<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class TrickRepository extends EntityRepository
{
    public function getTrickWithComments($slug)
    {
        return $this->createQueryBuilder('trick')
            ->where('trick.slug = :slug')
            ->setParameter('slug', $slug)
            ->leftJoin('trick.comments', 'comments')
            ->getQuery()
            ->getOneOrNullResult();
    }

}