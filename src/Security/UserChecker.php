<?php

namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }
        
        // user is deleted, show a generic Account Not Found message.
        if (!$user->isEnabled()) {
            throw new CustomUserMessageAuthenticationException('Usuário não ativado');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        
    }
}