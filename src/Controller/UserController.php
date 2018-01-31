<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{

    // DISPLAYING FORM TO CREATE NEW USER
    public function createAction(Request $request)
    {

        $form = $this->createForm(UserType::class);
        $form->handleRequest($request);

        // Validation and submission of the form
        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();
            // Creating slug by replacing name spaces with a dash
            $user->setCreatedAt(new \DateTime('now'));
            $user->setRole('user');
            $user->setActive(true);
            //ADD HERE THE $trick->setUser using COOKIE

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Your account has been created'
            );

            return $this->redirectToRoute('trick_list');
        }

        return $this->render('user/newUser.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}