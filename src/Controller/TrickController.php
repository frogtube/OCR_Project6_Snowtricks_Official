<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TrickController extends Controller
{

    // LISTING TRICKS FOR HOMEPAGE
    public function listAction() {

        $tricks = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTricksWithImage();

        return $this->render('trick/listTrick.html.twig', array(
            'tricks' => $tricks,
        ));
    }

    // SHOWING A UNIQUE TRICK WITH FULL DATA
    public function showAction(Request $request, $slug) {

        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTrickWithCommentsImagesAndVideos($slug);

        if(!$trick) {
            throw $this->createNotFoundException('No trick found for slug'.$slug);
        }

        // Form to insert a new comment
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $comment = $form->getData();
            $comment->setCreatedAt(new \DateTime('now'));
            $comment->setTrick($trick);
            //ADD HERE THE $trick->setUser using COOKIE

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('trick_show', array('slug' => $trick->getSlug()));
        }





        return $this->render('trick/showTrick.html.twig', array(
            'trick' => $trick,
            'form' => $form->createView(),
        ));

    }

    // DISPLAYING FORM TO CREATE NEW TRICK
    public function createAction(Request $request) {

        $form = $this->createForm(TrickType::class);
        $form->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();
            // Creating slug by replacing name spaces with a dash
            $trick->setSlug(strtolower(str_replace(' ', '-', $trick->getName())));
            $trick->setCreatedAt(new \DateTime('now'));
            //ADD HERE THE $trick->setUser using COOKIE

            // If new Trick already exists, redirection to the list of trick with error message
            if ($this->isTrickAlreadyExisting($trick->getSlug())){
                $this->addFlash(
                    'error',
                    'Your trick '.$trick->getName().' already exists'
                );
                return $this->redirectToRoute('trick_list');
            }

            // If the new trick does not exists, it is added to db
            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            $this->addFlash(
                'success',
                'Your new trick '.$trick->getName().' is saved'
            );

            return $this->redirectToRoute('trick_list');
        }

        return $this->render('trick/newTrick.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    // DISPLAYING FORM TO EDIT AN EXISTING TRICK
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
                'The trick '.$trick->getName().' has been updated'
            );

            return $this->redirectToRoute('trick_list');
        }

        return $this->render('trick/newTrick.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    // DELETING AN EXISTING TRICK
    public function deleteAction($slug)
    {
        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTrick($slug);

        $em = $this->getDoctrine()->getManager();
        $em->remove($trick);
        $em->flush();

        $this->addFlash(
            'success',
            'The trick '.$trick->getName().' has been deleted'
        );

        return $this->redirectToRoute('trick_list');

    }


    public function isTrickAlreadyExisting($slug): bool
    {
        $trickCount = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->countExistingTricks($slug);

        return ($trickCount != 0) ? true : false;

    }

}