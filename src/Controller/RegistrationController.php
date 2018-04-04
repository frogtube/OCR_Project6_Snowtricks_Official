<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller
{
    public function registrationAction(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        \Swift_Mailer $mailer)
    {
        // Building the form
        $user = new User();
        $form = $this->createForm(UserRegistrationType::class, $user);

        // Handling the submit on POST
        $form->handleRequest($request);

        // Upon valid form submission
        if($form->isSubmitted() && $form->isValid()) {

            // Encoding the password
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->createUser($password, $user);

            // Saving the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // Adding success flash message
            $this->addFlash(
                'success',
                'Congratulations '.$user->getUsername().'! Your account has been successfully created.'
            );

            // Sending confirmation email
            $username = $user->getUsername();
            $email = $user->getEmail();
            $message = (new \Swift_Message('Registration confirmation'))
                ->setFrom('send@example.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'Emails/registration.html.twig',
                        array('username' => $username)
                    ),
                    'text/html'
                );

            $mailer->send($message);

            return $this->redirectToRoute('trick_list');
        }

        return $this->render(
            'registration/register.html.twig',
            array('form' => $form->createView())
        );
    }

}