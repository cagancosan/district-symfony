<?php

namespace App\Controller;

use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatsController extends AbstractController
{
    private $platRepo;

    public function __construct(PlatRepository $platRepo)
    {
        $this->platRepo = $platRepo;
    }

    #[Route('/plats', name: 'app_plats')]
    public function listePlats(): Response
    {
        $lesPlats = $this->platRepo->findBy([], ['categorie' => 'ASC']);
        return $this->render('plats/listPlats.html.twig', [
            'lesPlats' => $lesPlats,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }

    #[Route('/plats/{categorie_id}', name: 'app_plats.categorie_id')]
    public function listPlatsByCategorie($categorie_id): Response
    {
        $lesPlats = $this->platRepo->findBy(['categorie' => $categorie_id], ['libelle' => 'ASC']);
        return $this->render('plats/listPlats.html.twig', [
            'lesPlats' => $lesPlats,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
