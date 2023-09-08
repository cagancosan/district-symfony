<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Repository\UtilisateurRepository;
use App\Security\UserFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegisterController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(
        EmailVerifier $emailVerifier,
    ) {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager, UserAuthenticatorInterface $userAuthenticator, UserFormAuthenticator $authenticator): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(['ROLE_CLIENT']);
            $entityManager->persist($user);
            $entityManager->flush();
            $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('the@district.com', 'The District'))
                    ->to($user->getEmail())
                    ->subject("Confirmation de l'adresse e-mail")
                    ->htmlTemplate('security/confirm_email.html.twig')
            );
            $this->addFlash('success', 'E-mail de vérification envoyé. Veillez à cliquer sur le lien contenu dans le mail.');
            return $userAuthenticator->authenticateUser($user, $authenticator, $request);
        }
        return $this->render('security/register.html.twig', [
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/resend', name: 'app_verify_resend')]
    public function verifyResendEmail(UtilisateurRepository $utilisateurRepository)
    {
        $user = new Utilisateur();
        $useremail = $this->getUser()->getUserIdentifier();
        if ($useremail) {
            $user = $utilisateurRepository->findOneBy(["email" => $useremail]);
        }
        $this->emailVerifier->sendEmailConfirmation(
            'app_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('the@district.com', 'The District'))
                ->to($user->getEmail())
                ->subject("Confirmation de l'adresse e-mail")
                ->htmlTemplate('security/confirm_email.html.twig')
        );
        $this->addFlash('success', 'E-mail de vérification envoyé. Veillez à cliquer sur le lien contenu dans le mail.');
        return $this->redirectToRoute('app_profile');
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UtilisateurRepository $utilisateurRepository, UserAuthenticatorInterface $userAuthenticator, UserFormAuthenticator $authenticator): Response
    {
        $user = new Utilisateur();
        $id = $request->query->get('id');
        if (null === $id) {
            return $this->redirectToRoute('app_home');
        }
        $user = $utilisateurRepository->find($id);
        if (null === $user) {
            return $this->redirectToRoute('app_home');
        }
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_home');
        }
        $this->addFlash('success', 'Votre adresse e-mail est désormais vérifiée.');
        return $userAuthenticator->authenticateUser($user, $authenticator, $request);
    }
}
