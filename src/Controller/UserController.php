<?php

namespace App\Controller;


use App\Entity\Image;
use App\Entity\User;
use App\Form\UserRegistrationType;
use App\Form\UserEditType;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    // DISPLAYING FORM TO CREATE NEW USER
    public function editAction(Request $request, FileUploader $fileUploader)
    {
        $user = $this->getUser();

        if($user->getImage()) {
            $user->setImage(
                new Image($this->getParameter('images_directory').'/'.$user->getImage()->getFilename())
            );
        }

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);


        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            // If user uploads a picture
            if($user->getImage()->getFilename() != null)
            {

                // Checking if an avatar image already exists
                $oldAvatar = $this->getDoctrine()
                    ->getRepository(Image::class)
                    ->getImageByUser($user);

                // If it does, the avatar image is deleted
                if ($oldAvatar)
                {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($oldAvatar);
                    $em->flush();
                }

                // Image upload
                /** @var Image $image */
                $file = $user->getImage()->getFilename();
                $filename = $fileUploader->upload($file);
                $avatar = $user->getImage();

                $avatar->setFilename($filename);
                $avatar->setUser($user);
            }

            // Deleting image entity if no file was uploaded
            if($user->getImage()->getFilename() == null)
            {
                $user->setImage(null);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Your account has been modified'
            );

            return $this->redirectToRoute('trick_list');
        }

        return $this->render('user/userEdit.html.twig', array(
            'form' => $form->createView(),
            'user' => $user,
        ));
    }

    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');

    }
}