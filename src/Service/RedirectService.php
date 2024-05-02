<?php

namespace App\Service;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RedirectService
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function index()
    {
        $token = $this->tokenStorage->getToken();

        if ($token !== null && $token->getUser() !== null && $token->getUser() instanceof UserInterface) {
            $user = $token->getUser();
            return $user;
        }
        return false;
    }
}
