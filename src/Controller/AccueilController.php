<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    private $categorieRepo;
    private $platRepo;

    public function __construct(CategorieRepository $categorieRepo, PlatRepository $platRepo)
    {
        $this->categorieRepo = $categorieRepo;
        $this->platRepo = $platRepo;
    }

    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        $lesCategories = $this->categorieRepo->findMostPopularCategories();
        $lesPlats = $this->platRepo->findMostPopularPlats();
        return $this->render('accueil/accueil.html.twig', [
            'lesCategories' => $lesCategories,
            'lesPlats' => $lesPlats,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
