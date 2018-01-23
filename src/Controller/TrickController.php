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

    // Controller of HomePage listing the tricks
    public function listAction() {

        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTricksWithImage();


        return $this->render('trick/listTrick.html.twig', array(
            'tricks' => $tricks,
        ));
    }

    // Controller displaying a unique Trick with full details
    public function showAction($slug) {

        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTrickWithCommentsImagesAndVideos($slug);

        if(!$trick) {
            throw $this->createNotFoundException('No trick found for id'.$slug);
        }

        return $this->render('trick/showTrick.html.twig', array(
            'trick' => $trick,
        ));

    }

    // Controller displaying the form to create a new Trick
    public function createAction(Request $request) {


        $form = $this->createForm(TrickType::class);
        $form->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            $trick->setCreatedAt(new \DateTime('now'));
            // Creating slug by replacing name spaces with a dash
            $trick->setSlug(strtolower(str_replace(' ', '-', $trick->getName())));
            //ADD HERE THE $trick->setUser using COOKIE
            // dump($trick); die;
            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            $this->addFlash(
                'success',
                'Your new trick is saved'
            );

            return $this->redirectToRoute('trick_list');
        }

        return $this->render('trick/newTrick.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function editAction(Request $request, $slug)
    {
        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTrick($slug);

        $form = $this->createForm(TrickType::class, $trick);
        $form->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            $trick->setCreatedAt(new \DateTime('now'));
            // Creating slug by replacing name spaces with a dash
            $trick->setSlug(strtolower(str_replace(' ', '-', $trick->getName())));
            //ADD HERE THE $trick->setUser using COOKIE
            // dump($trick); die;s
            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            $this->addFlash(
                'success',
                'Your new trick is saved'
            );

            return $this->redirectToRoute('trick_list');
        }

        return $this->render('trick/newTrick.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}