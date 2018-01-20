<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTrickWithComments($slug);

        if(!$trick) {
            throw $this->createNotFoundException('No trick found for id'.$slug);
        }

        return $this->render('trick/showTrick.html.twig', array(
            'trick' => $trick,
        ));

    }

    public function createAction(Request $request) {

        $trick = new Trick();
        $trick->setCreatedAt(new \DateTime('now'));

        $form = $this->createForm(TrickType::class, $trick);

        // var_dump($trick);

        $form->handleRequest($request);

        if ($form->isSubmitted() ) {

            $trick = $form->getData();

            // Creating slug by replacing name spaces with a dash
            $trick->setSlug(str_replace(' ', '-', $trick->getName()));
            //ADD HERE THE $trick->setUser WITH THE COOKIE


            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            return $this->redirectToRoute('trick_show', [
                'slug' => $trick->getSlug()
            ]);
        }



        return $this->render('trick/newTrick.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}