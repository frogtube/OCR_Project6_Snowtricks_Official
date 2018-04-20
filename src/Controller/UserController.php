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

        $form = $this->createForm(UserEditType::class, $user)
                     ->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            // If user uploads a picture
            if($user->getImage()->getFilename() != null) {

                // Checking if an avatar image already exists
                $oldAvatar = $this->getDoctrine()
                    ->getRepository(Image::class)
                    ->getImageByUser($user);
                // If it does, the avatar image is deleted
                if ($oldAvatar) {
                    $em = $this->getDoctrine()->getManager();
                    $em->remove($oldAvatar);
                    $em->flush();
                }

                $image = $user->getImage();
                $image->setUser($user);

                $em = $this->getDoctrine()->getManager();
                $em->persist($image);
                $em->flush();
            }

            // Deleting image entity if no file was uploaded
            if($user->getImage()->getFilename() == null) {
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

    public function deleteAvatarAction()
    {
        $image = $this->getUser()->getImage();

        $em = $this->getDoctrine()->getManager();
        $em->remove($image);
        $em->flush();

        $this->addFlash(
            'success',
            'Votre avatar a bien ete supprimé'
        );

        return $this->redirectToRoute('user_edit');

    }
}