<?php

namespace App\Controller;

use App\Entity\Plat;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatsController extends AbstractController
{
    #[Route('/plats', name: 'app_plats')]
    public function index(ManagerRegistry $mr): Response
    {
        $repoPlat = $mr->getRepository(Plat::class);
        $lesPlats = $repoPlat->findAll();
        return $this->render('plats/index.html.twig', [
            'lesPlats' => $lesPlats,
        ]);
    }
}
