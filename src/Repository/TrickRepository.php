<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr;

class TrickRepository extends EntityRepository
{
    public function getTrick($slug)
    {
        return $this->createQueryBuilder('trick')
            ->where('trick.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getTricksWithImage()
    {
        return $this->createQueryBuilder('trick')
            ->leftJoin('trick.images', 'image')
            ->getQuery()
            ->getResult();
    }

    public function getTrickWithCommentsImagesAndVideos($slug)
    {
        return $this->createQueryBuilder('trick')
            ->where('trick.slug = :slug')
            ->setParameter('slug', $slug)
            ->leftJoin('trick.comments', 'comments')
            ->leftJoin('trick.images', 'images')
            ->leftJoin('trick.videos', 'videos')
            ->getQuery()
            ->getOneOrNullResult();
    }

}