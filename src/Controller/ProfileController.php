<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    private $userRepo;

    public function __construct(UtilisateurRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }
    #[Route('/profil', name: 'app_profile')]
    public function index(): Response
    {
        $useremail = $this->getUser()->getUserIdentifier();
        if ($useremail) {
            $infos = $this->userRepo->findOneBy(["email" => $useremail]);
        }

        return $this->render('profile/index.html.twig', [
            'infos' => $infos,
            'cookie' => isset($_COOKIE['theme']) ? $_COOKIE['theme'] : null,
        ]);
    }
}
