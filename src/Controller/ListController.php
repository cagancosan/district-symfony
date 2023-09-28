<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\PlatRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

    #[Route('/recherche', name: 'app_search')]
    public function search(Request $request): Response
    {
        $search = $request->query->get('recherche');
        if ($search) {
            $categories = $this->categorieRepo->searchCategorie($search);
            $foods = $this->platRepo->searchPlat($search);
            return $this->render('list/search.html.twig', [
                'search' => $search,
                'categories' => $categories,
                'foods' => $foods,
                'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
            ]);
        }
    }

    #[Route('/categories/{page}', name: 'app_categories', condition: "params['page'] > 0")]
    public function listCategorie($page = 1): Response
    {
        $numberToShow = 6;
        $categories = $this->categorieRepo->findBy(['active' => 1], ['libelle' => 'ASC'], $numberToShow, ($page - 1) * $numberToShow);
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
        $foods = $this->platRepo->findBy(['active' => 1], ['categorie' => 'ASC']);
        return $this->render('list/listFoods.html.twig', [
            'foods' => $foods,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/plats/{categorie}/{page}', name: 'app_foods.categorie', condition: "params['page'] > 0")]
    public function listPlatsByCategorie(Categorie $categorie, $page = 1): Response
    {
        $numberToShow = 4;
        $foods = $this->platRepo->findBy(['categorie' => $categorie->getId(), 'active' => 1], ['libelle' => 'ASC'], $numberToShow, ($page - 1) * $numberToShow);
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
