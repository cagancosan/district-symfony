<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatsController extends AbstractController
{
    private $platRepo;
    private $categorieRepo;

    public function __construct(PlatRepository $platRepo, CategorieRepository $categorieRepo)
    {
        $this->platRepo = $platRepo;
        $this->categorieRepo = $categorieRepo;
    }

    #[Route('/plats', name: 'app_plats')]
    public function listePlats(): Response
    {
        $lesPlats = $this->platRepo->findBy([], ['categorie' => 'ASC']);
        return $this->render('plats/listePlats.html.twig', [
            'lesPlats' => $lesPlats,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
