<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/mentions', name: 'app_notices')]
    public function mentions(): Response
    {
        return $this->render('legal/index.html.twig', [
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
    #[Route('/politique', name: 'app_policy')]
    public function policy(): Response
    {
        return $this->render('legal/index.html.twig', [
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
