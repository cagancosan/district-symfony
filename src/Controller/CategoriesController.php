<?php

namespace App\Controller;

use App\Repository\CategorieRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    private $categorieRepo;

    public function __construct(CategorieRepository $categorieRepo)
    {
        $this->categorieRepo = $categorieRepo;
    }

    #[Route('/categories', name: 'app_categories')]
    public function listCategorie(): Response
    {
        $lesCategories = $this->categorieRepo->findBy([], ['libelle' => 'ASC']);
        return $this->render('categories/listCategories.html.twig', [
            'lesCategories' => $lesCategories,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
