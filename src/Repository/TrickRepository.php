<?php

namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class TrickRepository extends EntityRepository
{
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