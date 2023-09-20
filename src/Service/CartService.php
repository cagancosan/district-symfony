<?php

namespace App\Service;

use App\Entity\Plat;
use App\Repository\PlatRepository;
use Exception;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    public function __construct()
    {
    }

    public function list(SessionInterface $session, PlatRepository $foodRepo): array
    {
        try {
            $cart = $session->get("cart", []);
            $cartList = [];
            foreach ($cart as $key => $value) {
                $c = $foodRepo->find($key);
                $cartList[] = $c;
            }
        } catch (Exception $e) {
            return [];
        }
        return $cartList;
    }

    public function add(SessionInterface $session, Plat $food): bool
    {
        try {
            $cart = $session->get("cart", []);
            $size = $session->get("size", 0);
            if (!isset($cart[$food->getId()]))
                $cart[$food->getId()] = 0;
            $cart[$food->getId()]++;
            $session->set("cart", $cart);
            $session->set("size", ++$size);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function remove(SessionInterface $session, Plat $food): bool
    {
        try {
            $cart = $session->get("cart", []);
            $size = $session->get("size", 0);
            $cart[$food->getId()]--;
            if ($cart[$food->getId()] <= 0) {
                unset($cart[$food->getId()]);
            }
            $session->set("cart", $cart);
            $session->set("size", --$size);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
