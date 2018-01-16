<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TrickController extends Controller
{
    public function listAction() {
        return $this->render('trick/listTrick.html.twig', array(

        ));
    }

    public function showAction() {
        return $this->render('trick/showTrick.html.twig', array(

        ));
    }

    public function createAction() {
        return $this->render('trick/newTrick.html.twig', array(

        ));
    }

}