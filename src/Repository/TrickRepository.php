<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\ORM\Query\Expr;

class TrickRepository extends EntityRepository
{
    public function getTrick($slug)
    {
        return $this->createQueryBuilder('trick')
            ->andwhere('trick.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getTricksWithImage()
    {
        return $this->createQueryBuilder('trick')
            ->orderBy('trick.name', 'ASC')
            ->leftJoin('trick.images', 'image')
            ->addSelect('image')
            ->getQuery()
            ->getResult();
    }

    public function getTrickWithCommentsImagesAndVideos($slug)
    {
        return $this->createQueryBuilder('trick')
            ->andwhere('trick.slug = :slug')
            ->leftJoin('trick.comments', 'comments')
            ->addSelect('comments')
            ->orderBy('comments.createdAt', 'DESC')
            ->leftJoin('trick.images', 'images')
            ->addSelect('images')
            ->leftJoin('trick.videos', 'videos')
            ->addSelect('videos')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /* NOT USED
    public function countExistingTricks($slug)
    {
        return $this->createQueryBuilder('trick')
            ->andwhere('trick.slug = :slug')
            ->setParameter('slug', $slug)
            ->select('COUNT(trick)')
            ->getQuery()
            ->getSingleScalarResult();
    }
    */

}