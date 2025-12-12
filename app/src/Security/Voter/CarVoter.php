<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;


final class CarVoter extends Voter
{
    public const EDIT = 'CAR_EDIT';
    public const VIEW = 'CAR_VIEW';
    public const DELETE = 'CAR_DELETE';
   
    protected function supports(string $attribute, mixed $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::EDIT, self::VIEW, self::DELETE])
            && $subject instanceof \App\Entity\Car;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
     
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::EDIT:
            case self::DELETE:
                    dd('truc');
                    return $subject-> getUser() === $user;
                break;
            case self::ADD:
                if(in_array('ROLE_USER', $user-> getRoles())) 
                {
                    return true;
                }
                break;

            case self::VIEW:
               return true;
                break;
        }

        return false;
    }
}