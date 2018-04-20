<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\ResetPasswordRequestType;
use App\Form\ResetPasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', array(
            'last_username' =>$lastUsername,
            'error' => $error,
        ));

    }

    public function resetPasswordRequest(Request $request, \Swift_Mailer $mailer)
    {

        $form = $this->createForm(ResetPasswordRequestType::class);
        $form->handleRequest($request);

        // Upon valid form submission
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $username = $data['username'];
            $email = $data['email'];

            $user = $this->getDoctrine()
                         ->getRepository(User::class)
                         ->findUserWithEmailAndUsername($username, $email);

            // Generating the token for password reset
            $resetPasswordToken = bin2hex(random_bytes(25));
            $user->setResetPasswordToken($resetPasswordToken);
            $user->setResetPasswordTokenTimestamp(new \DateTime());

            // Generating the url for the password reset
            $passwordResetUrl = 'http://localhost:8000/reset-password'.'?token='.$resetPasswordToken;

            dump($email, $username, $user, $resetPasswordToken);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            // Sending confirmation email
            $username = $user->getUsername();
            $email = $user->getEmail();
            $message = (new \Swift_Message('Password reset'))
                ->setFrom('send@snowtricks.com')
                ->setTo($email)
                ->setBody(
                    $this->renderView(
                    // templates/Emails/
                        'Emails/passwordResetEmail.html.twig',
                        array(
                            'username' => $username,
                            'passwordResetUrl' => $passwordResetUrl,
                        )
                    ),
                    'text/html'
                );

            $mailer->send($message);


            $this->addFlash(
                'success',
                'An email has been sent to reset your password'
            );

            return $this->redirectToRoute('trick_list');

        }

        return $this->render('Security/passwordResetRequest.html.twig', array(
            'form' => $form->createView(),
        ));
    }


    public function resetPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        // Generating the resetPasswordToken from url
        if(isset($_GET['token'])) {
            $urlToken = substr($_GET['token'], 0, 25);
        } else {
            // Redirection to first step of the procedure
            $this->addFlash(
                'error',
                'Your password has not been reset. Please start again the procedure'
            );
            return $this->redirectToRoute('reset_password_request');

        }




        $form = $this->createForm(ResetPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $username = $data->getUsername();
            $email = $data->getEmail();

            // Fetching if user exists in the database
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findUserWithEmailAndUsername($username, $email);


            if ($user && $urlToken == $user->getResetPasswordToken()) {

                // Generating the timestamp + 10min of the resetPasswordToken
                $tokenExpirationDatetime = $user->getResetPasswordTokenTimestamp()->add(new \DateInterval('PT' . 1 . 'M'));

                if (new \DateTime() < $tokenExpirationDatetime) {

                    // Setting the new password to user
                    $password = $passwordEncoder->encodePassword($user, $data->getPlainPassword());
                    $user->setPassword($password);
                    $user->setResetPasswordToken(null);
                    $user->setResetPasswordTokenTimestamp(null);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();

                    $this->addFlash(
                        'success',
                        'Your password has been reset. You can now log in'
                    );

                    return $this->redirectToRoute('login');
                } else {
                    $this->addFlash(
                        'error',
                        'The url is expired. Please start again the procedure to change your password'
                    );
                }

            } else {
                $this->addFlash(
                    'error',
                    'Your password has not been reset. Your email, username or the generated url does not match'
                );
            }

        }

        return $this->render('Security/passwordReset.html.twig', array(
            'form' => $form->createView()
        ));
    }

}