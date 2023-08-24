<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = new Contact();
            $data = $form->getData();
            $message = $data;
            $entityManager->persist($message);
            $entityManager->flush();
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
