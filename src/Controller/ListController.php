<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    private $categorieRepo;
    private $platRepo;

    public function __construct(CategorieRepository $categorieRepo, PlatRepository $platRepo)
    {
        $this->categorieRepo = $categorieRepo;
        $this->platRepo = $platRepo;
    }

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        $categories = $this->categorieRepo->findMostPopularCategories();
        $foods = $this->platRepo->findMostPopularPlats();
        return $this->render('list/home.html.twig', [
            'categories' => $categories,
            'foods' => $foods,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/categories', name: 'app_categories')]
    public function listCategorie(): Response
    {
        $categories = $this->categorieRepo->findBy([], ['libelle' => 'ASC']);
        return $this->render('list/listCategories.html.twig', [
            'categories' => $categories,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/plats', name: 'app_foods')]
    public function listPlats(): Response
    {
        $foods = $this->platRepo->findBy([], ['categorie' => 'ASC']);
        return $this->render('list/listFoods.html.twig', [
            'foods' => $foods,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/plats/{categorie_id}', name: 'app_foods.categorie_id')]
    public function listPlatsByCategorie($categorie_id): Response
    {
        $foods = $this->platRepo->findBy(['categorie' => $categorie_id], ['libelle' => 'ASC']);
        return $this->render('list/listFoods.html.twig', [
            'foods' => $foods,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
