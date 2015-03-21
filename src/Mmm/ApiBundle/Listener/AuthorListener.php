<?php

namespace Mmm\ApiBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Mmm\ApiBundle\Entity\AuthorInterface;
use Mmm\ApiBundle\Entity\User;

class AuthorListener
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if ($entity instanceof AuthorInterface && $user = $this->getUser()) {
            $entity->setCreatedBy($user);
        }
    }

    public function getUser()
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return;
        }

        if (!($user = $token->getUser()) instanceof User) {
            return;
        }

        return $user;
    }
}