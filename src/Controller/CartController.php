<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Repository\PlatRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

        return $this->render('cart/index.html.twig', [
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
}
