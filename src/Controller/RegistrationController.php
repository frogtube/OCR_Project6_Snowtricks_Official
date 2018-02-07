<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    public function registrationAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // Building the form
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);

        // Handling the submit on POST
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            // Encoding the password
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Adding required fields
            $user->setCreatedAt(new \DateTime('now'));
            $user->setRoles(array('ROLE_USER'));

            // Saving the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Congratulations '.$user->getUsername().'! Your account has been successfully created.'
            );

            return $this->redirectToRoute('trick_list');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

}