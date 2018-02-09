<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserRegistrationType;
use App\Form\UserEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    // DISPLAYING FORM TO CREATE NEW USER
    public function editAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            $image = $user->getImage();
            $image->setUser($user);

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
        ));
    }

    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');

    }
}