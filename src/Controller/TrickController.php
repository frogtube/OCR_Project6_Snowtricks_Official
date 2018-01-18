<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Trick;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TrickController extends Controller
{
    public function listAction() {

        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->findAll();

        return $this->render('trick/listTrick.html.twig', array(
            'tricks' => $tricks,
        ));
    }

    public function showAction($slug) {

        $trickName = str_replace('_', ' ', $slug);
        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->findOneBy(array(
                'name' => $trickName,
            ));

        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findBy(array(
                'trick' => $trick->getId()
            ));

        if(!$trick) {
            throw $this->createNotFoundException('No trick found for id'.$trickName);
        }

        return $this->render('trick/showTrick.html.twig', array(
            'trick' => $trick,
            'comments' => $comments
        ));
    }

    public function createAction() {
        return $this->render('trick/newTrick.html.twig', array(

        ));
    }

}