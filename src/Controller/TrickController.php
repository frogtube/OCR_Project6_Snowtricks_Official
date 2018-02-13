<?php

namespace App\Controller;


use App\Entity\Comment;
use App\Entity\Image;
use App\Entity\Trick;
use App\Form\CommentType;
use App\Form\TrickEditType;
use App\Form\TrickType;
use App\Service\FileUploader;
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
            $comment->setUser($this->getUser());
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
    public function createAction(Request $request, FileUploader $fileUploader) {

        $trick = new Trick();
        $form = $this->createForm(TrickType::class);
        $form->handleRequest($request);
        $trick = $form->getData();


        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {


            // Adding required trick entity attributes
            $trick->setName(ucfirst($trick->getName()));
            $trick->setSlug(strtolower(str_replace(' ', '-', $trick->getName())));
            $trick->setCreatedAt(new \DateTime('now'));
            $trick->setUser($this->getUser());

            // Image upload
            $images = $trick->getImages();
            /** @var Image $image */
            foreach ($images as $image)
            {
                $file = $image->getFilename();
                $filename = $fileUploader->upload($file);
                $image->setFilename($filename);
                $image->setTrick($trick);
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
        $trick = $this->getDoctrine()
            ->getRepository(Trick::class)
            ->getTrick($slug);


        $form = $this->createForm(TrickEditType::class, $trick);
        $form->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $trick = $form->getData();

            $trick->setName(ucfirst($trick->getName()));
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

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}