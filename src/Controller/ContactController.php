<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Service\MailService;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager, MailService $ms): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = new Contact();
            $data = $form->getData();
            $to = $data->getEmail();
            $message = $data;
            $sent = $ms->sendEmail('the@district.com', $message->getEmail(), $message->getObjet(), $message->getMessage());
            if ($sent) {
                $this->addFlash('success', "Nous confirmons la réception de votre message, vous recevrez une réponse sous 48H à l'adresse suivante : $to.");
            } else {
                $this->addFlash('error', "Une erreur est survenue lors de l'envoi du mail.");
            }
            $entityManager->persist($message);
            $entityManager->flush();
            return $this->redirectToRoute('app_contact');
        }
        return $this->render('contact/contact.html.twig', [
            'form' => $form,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
