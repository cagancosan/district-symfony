<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Plat;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(ManagerRegistry $mr): Response
    {
        $repoCat = $mr->getRepository(Categorie::class);
        $lesCategories = $repoCat->findAll();
        return $this->render('categories/index.html.twig', [
            'lesCategories' => $lesCategories,
        ]);
    }
    #[Route('/categories/{id<\d+>}', name: 'app_categories.id')]
    public function oneCategory(ManagerRegistry $mr, $id): Response
    {
        $repoPlat = $mr->getRepository(Plat::class);
        $lesPlats = $repoPlat->findBy(['categorie' => $id]);
        return $this->render('categories/uneCategorie.html.twig', [
            'lesPlats' => $lesPlats,
        ]);
    }
}
