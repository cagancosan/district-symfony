<?php

namespace App\Controller;

use App\Entity\Categorie;
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

    #[Route('/categories/{page}', name: 'app_categories', condition: "params['page'] > 0")]
    public function listCategorie($page = 1): Response
    {
        $numberToShow = 6;
        $categories = $this->categorieRepo->findBy([], ['libelle' => 'ASC'], $numberToShow, ($page - 1) * $numberToShow);
        if ($categories) {
            $categoriesCount = $this->categorieRepo->countCategories();
            return $this->render('list/listCategories.html.twig', [
                'categories' => $categories,
                'currentPage' => $page,
                'totalPages' => ceil($categoriesCount / $numberToShow),
                'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
            ]);
        } else {
            return $this->redirectToRoute('app_categories');
        }
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

    #[Route('/plats/{categorie}/{page}', name: 'app_foods.categorie', condition: "params['page'] > 0")]
    public function listPlatsByCategorie(Categorie $categorie, $page = 1): Response
    {
        $numberToShow = 4;
        $foods = $this->platRepo->findBy(['categorie' => $categorie->getId()], ['libelle' => 'ASC'], $numberToShow, ($page - 1) * $numberToShow);
        if ($foods) {
            $foodsCount = $this->platRepo->countPlats($categorie->getId());
            return $this->render('list/listFoodsByCategorie.html.twig', [
                'foods' => $foods,
                'currentPage' => $page,
                'totalPages' => ceil($foodsCount / $numberToShow),
                'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
            ]);
        } else {
            return $this->redirectToRoute('app_categories');
        }
    }
}
