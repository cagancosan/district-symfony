<?php

namespace App\Controller;

use Exception;
use App\Entity\Plat;
use App\Entity\Detail;
use App\Entity\Commande;
use App\Form\OrderFormType;
use App\Service\CartService;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'app_cart')]
    public function cart(CartService $cs): Response
    {
        $cartList = $cs->list();
        return $this->render('cart/cart.html.twig', [
            'cartList' => $cartList,
            'controller_name' => 'CartController',
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/panier/ajouter/{food}', name: 'app_cart_add')]
    public function cartAdd(Request $request, CartService $cs, Plat $food): RedirectResponse
    {
        $cs->add($food);
        $route = $request->headers->get('referer');
        $this->addFlash('success', $food->getLibelle() . " ajouté avec succès dans le panier !");
        return $this->redirect($route);
    }

    #[Route('/panier/supprimer/{food}', name: 'app_cart_remove')]
    public function cartRemove(Request $request, CartService $cs, Plat $food): Response
    {
        $cs->remove($food);
        $route = $request->headers->get('referer');
        $this->addFlash('success', $food->getLibelle() . " supprimé avec succès dans le panier !");
        return $this->redirect($route);
    }

    #[Route('/commande', name: 'app_cart_order')]
    public function order(Request $request, SessionInterface $session, EntityManagerInterface $entityManager, PlatRepository $foodRepo, UserInterface $user): Response
    {
        $cart = $session->get("cart", []);
        if (!$cart) {
            $this->addFlash('error', "Veuillez ajouter des plats à votre panier avant d'accéder à la page order.");
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
            try {
                $order = new Commande();
                $order = $form->getData();
                $now = new \DateTime();
                $order->setDateCommande($now);
                $order->setTotal($total);
                $order->setEtat(0);
                $order->setUtilisateur($user);
                foreach ($cart as $key => $value) {
                    $detail = new Detail();
                    $detail->setPlat($foodRepo->find($key));
                    $detail->setCommande($order);
                    $detail->setQuantite($value);
                    $entityManager->persist($detail);
                }

                $entityManager->persist($order);
                $entityManager->flush();
                $this->addFlash('success', "Votre commande a bien été prise en compte !");
                $session->set("cart", []);
                $session->set("size", 0);
                return $this->redirectToRoute('app_home');
            } catch (Exception $e) {
                $this->addFlash('error', "Erreur lors de la commande, veuillez réessayer ou contacter le restaurant pour plus d'informations.");
                return $this->redirectToRoute('app_home');
            }
        }
        return $this->render('cart/order.html.twig', [
            'form' => $form,
            'total' => $total,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
