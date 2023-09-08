<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'app_cart')]
    public function cart(SessionInterface $session, PlatRepository $foodRepo): Response
    {
        $cart = $session->get("cart", []);
        $cartList = [];

        foreach($cart as $key => $value){
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
    public function cartAdd(SessionInterface $session, Plat $food): Response
    {
        $cart = $session->get("cart", []);
        if (!isset($cart[$food->getId()])) {
            $cart[$food->getId()] = 0;
        }
        $cart[$food->getId()]++;
        $session->set("cart", $cart);

        return $this->redirectToRoute('app_cart');
    }
}
