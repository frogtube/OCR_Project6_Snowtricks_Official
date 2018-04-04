<?php

namespace App\Controller;

use App\Entity\Image;
use App\Entity\Trick;
use App\Form\TrickType;
use App\Form\CommentType;
use App\Form\TrickEditType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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

        $trick = $this->getDoctrine()->getRepository(Trick::class)
                                     ->getTrickWithCommentsImagesAndVideos($slug);

        if(!$trick) {
            throw $this->createNotFoundException('No trick found for slug'.$slug);
        }

        // Form to insert a new comment
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        // Upon valid form submission
        if ($form->isSubmitted() && $form->isValid()) {

            // Creating the comment
            $comment = $form->getData();
            $comment->createComment($trick, $this->getUser());

            // Persisting the comment
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

    // DISPLAYING FORM TO CREATE A NEW TRICK
    public function createAction(Request $request)
    {
        $trick = new Trick();

        $form = $this->createForm(TrickType::class, $trick)
                     ->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            // Creating the new trick
            $trick = $form->getData();

            // Adding required data to the new trick
            $trick->createTrick($trick->getName(), $this->getUser());

            // Setting trick_id to images
            foreach ($trick->getImages() as $image) {
                $image->setTrick($trick);
            }
            // Setting trick_id to videos
            foreach ($trick->getVideos() as $video) {
                $video->setTrick($trick);
            }

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
        $trick = $this->getDoctrine()->getRepository(Trick::class)
                                     ->getTrickWithImage($slug);

        $imagesDb = [];
        // Create a File in the filename attribute of the Image entity
        foreach ($trick->getImages() as $image) {
            $imagesDb[$image->getId()] = $image->getFilename();
            $file = new File($this->getParameter('images_directory').'/'.$image->getFilename());
            $image->setFilename($file);
            // Storing images files in case of validation error
            $files[] = $file;
        }

        $form = $this->createForm(TrickEditType::class, $trick)
                     ->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            // Setting trick_id to videos
            foreach ($trick->getVideos() as $video) {
                $video->setTrick($trick);
            }

            // Restoring filename if image not deleted
            foreach ($trick->getImages() as $image) {
                if ($image->getFilename() == null && array_key_exists($image->getId(), $imagesDb)) {
                    $image->setFilename($imagesDb[$image->getId()]);
                }
                $image->setTrick($trick);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($trick);
            $em->flush();

            $this->addFlash(
                'success',
                'The trick '.$trick->getName().' has been updated'
            );

            return $this->redirectToRoute('trick_list');
        }

        // Rescuing image files from form validation error
        if ($form->isSubmitted() && !$form->isValid()) {

            for ($i = 0; $i < count($trick->getImages()); $i++) {
                $trick->getImages()[$i]->setFilename($files[$i]);
            }

        }

            return $this->render('trick/editTrick.html.twig', array(
            'form' => $form->createView(),
            'trick' => $trick,
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

}