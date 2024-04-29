<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RedirectController extends AbstractController
{


    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/', name: 'app_redirect')]
    public function index(UserRepository $userRepository): Response
    {

        $token = $this->tokenStorage->getToken();

        if ($token !== null && $token->getUser() !== null && $token->getUser() instanceof UserInterface) {
            // L'utilisateur est connecté
            $user = $token->getUser();
            $roles = $user->getRoles();

            $id = $user->getFonction()->getId();

            if ($id != 4) {
                if (in_array('ROLE_ADMIN', $roles)) {
                    return $this->redirectToRoute('admin.dashboard.index');
                } else {
                    return $this->redirectToRoute('home');
                }
            } else {
                return $this->redirectToRoute('reception');
            }
        } else {
            // L'utilisateur n'est pas connecté
            return $this->redirectToRoute('app_login');
        }
    }
}
