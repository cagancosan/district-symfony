<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    private $platRepo;
    private $categorieRepo;

    public function __construct(PlatRepository $platRepo, CategorieRepository $categorieRepo)
    {
        $this->platRepo = $platRepo;
        $this->categorieRepo = $categorieRepo;
    }

    #[Route('/categories', name: 'app_categories')]
    public function listeCategorie(): Response
    {
        $lesCategories = $this->categorieRepo->findBy([], ['libelle' => 'ASC']);
        return $this->render('categories/listeCategories.twig', [
            'lesCategories' => $lesCategories,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/categories/{id}', name: 'app_categories.id')]
    public function uneCategorie($id): Response
    {
        $lesPlats = $this->platRepo->findBy(['categorie' => $id], ['libelle' => 'ASC']);
        return $this->render('categories/listePlatsParCategorie.twig', [
            'lesPlats' => $lesPlats,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
