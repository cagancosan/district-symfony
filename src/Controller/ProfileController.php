<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    private $utilisateurRepository;

    public function __construct(UtilisateurRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }
    #[Route('/profil', name: 'app_profile')]
    public function index(): Response
    {
        $useremail = $this->getUser()->getUserIdentifier();
        if ($useremail) {
            $infos = $this->utilisateurRepository->findOneBy(["email" => $useremail]);
        }

        return $this->render('profile/profile.html.twig', [
            'infos' => $infos,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
