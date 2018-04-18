<?php

namespace App\Controller;


use App\Entity\Image;
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

            // Generating the token for the activation of the account
            $activationToken = bin2hex(random_bytes(25));
            $user->setActivationToken($activationToken);

            // Generating the url for the activation of the account
            $accountActivationUrl = 'http://localhost:8000/account-activation'.'?token='.$activationToken;

            // Setting the default avatar
            $avatar = new Image();
            $avatar->setFilename('avatar_default.png');
            $avatar->setUser($user);

//            $user->setImage($avatar);

//            dump($user, $avatar); die();
            // Saving the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($avatar);
            $em->flush();

            // Adding success flash message
            $this->addFlash(
                'success',
                'Congratulations '.$user->getUsername().'! Your account has been successfully created. Go to your email to activate it'
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
                        array(
                            'username' => $username,
                            'url' => $accountActivationUrl,
                        )
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

    public function accountActivation(Request $request)
    {
        // Generating the resetPasswordToken from url
        $urlToken = substr($_GET['token'], 0, 25);

        // Fetching the user from database
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findUserWithActivationToken($urlToken);

        if ($user) {

            // Activating the user account
            $user->setIsActive(true);
            $user->setActivationToken(null);

            // Saving the user
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash(
                'success',
                'Your account is now active'
            );

            return $this->redirectToRoute('trick_list');

        } else {

            $this->addFlash(
                'error',
                'This url is no longer valid'
            );

            return $this->redirectToRoute('trick_list');

        }
    }

}