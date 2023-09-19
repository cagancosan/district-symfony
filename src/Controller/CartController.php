<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Commande;
use App\Form\OrderFormType;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'app_cart')]
    public function cart(SessionInterface $session, PlatRepository $foodRepo): Response
    {
        $cart = $session->get("cart", []);
        $cartList = [];

        foreach ($cart as $key => $value) {
            $c = $foodRepo->find($key);
            $cartList[] = $c;
        }

        return $this->render('cart/cart.html.twig', [
            'cart' => $cart,
            'cartList' => $cartList,
            'controller_name' => 'CartController',
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/panier/ajouter/{food}', name: 'app_cart_add')]
    public function cartAdd(Request $request, SessionInterface $session, Plat $food): Response
    {
        $cart = $session->get("cart", []);
        $size = $session->get("size", 0);
        if (!isset($cart[$food->getId()]))
            $cart[$food->getId()] = 0;
        $cart[$food->getId()]++;
        $session->set("cart", $cart);
        $session->set("size", ++$size);
        $this->addFlash('success', $food->getLibelle() . " ajouté avec succès dans le panier !");
        $route = $request->headers->get('referer');

        return $this->redirect($route);
    }

    #[Route('/panier/supprimer/{food}', name: 'app_cart_remove')]
    public function cartRemove(Request $request, SessionInterface $session, Plat $food): Response
    {
        $cart = $session->get("cart", []);
        $size = $session->get("size", 0);
        $cart[$food->getId()]--;
        if ($cart[$food->getId()] <= 0) {
            unset($cart[$food->getId()]);
        }
        $session->set("cart", $cart);
        $session->set("size", --$size);
        $this->addFlash('success', $food->getLibelle() . " supprimé avec succès dans le panier !");
        $route = $request->headers->get('referer');

        return $this->redirect($route);
    }

    #[Route('/commande', name: 'app_cart_order')]
    public function order(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, PlatRepository $foodRepo, UserInterface $user): Response
    {
        $cart = $session->get("cart", []);
        if (!$cart) {
            $this->addFlash('error', "Veuillez ajouter des plats à votre panier avant d'accéder à la page commande.");
            return $this->redirectToRoute('app_home');
        }
        $form = $this->createForm(OrderFormType::class);
        $form->handleRequest($request);
        $total = 0;
        foreach ($cart as $key => $value) {
            $c = $foodRepo->find($key);
            $total += ($c->getPrix() * $value);
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = new Commande();
            $contact = $form->getData();
            $now = new \DateTime();
            $contact->setDateCommande($now);
            $contact->setTotal($total);
            $contact->setEtat(0);
            $contact->setUtilisateur($user);
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', "Votre commande a bien été prise en compte !");
            return $this->redirectToRoute('app_home');
        }
        return $this->render('cart/order.html.twig', [
            'form' => $form,
            'total' => $total,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
