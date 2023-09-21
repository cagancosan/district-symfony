<?php

namespace App\Service;

use App\Entity\Plat;
use App\Repository\PlatRepository;
use Exception;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $session;
    private $foodRepo;
    
    public function __construct(RequestStack $rs, PlatRepository $foodRepo)
    {
        $this->session = $rs->getSession();
        $this->foodRepo = $foodRepo;
    }

    public function list(): array
    {
        try {
            $cart = $this->session->get("cart", []);
            $cartList = [];
            foreach ($cart as $key => $value) {
                $c = $this->foodRepo->find($key);
                $cartList[] = $c;
            }
        } catch (Exception $e) {
            return [];
        }
        return $cartList;
    }

    public function add(Plat $food): bool
    {
        try {
            $cart = $this->session->get("cart", []);
            $size = $this->session->get("size", 0);
            if (!isset($cart[$food->getId()]))
                $cart[$food->getId()] = 0;
            $cart[$food->getId()]++;
            $this->session->set("cart", $cart);
            $this->session->set("size", ++$size);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

    public function remove(Plat $food): bool
    {
        try {
            $cart = $this->session->get("cart", []);
            $size = $this->session->get("size", 0);
            $cart[$food->getId()]--;
            if ($cart[$food->getId()] <= 0) {
                unset($cart[$food->getId()]);
            }
            $this->session->set("cart", $cart);
            $this->session->set("size", --$size);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
