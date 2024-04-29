<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserSubscriber implements EventSubscriberInterface
{
    private $passwordEncoder;

    // public function __construct()
    // {
    //     $this->passwordEncoder = $passwordEncoder;
    // }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['hashUserPassword'],
        ];
    }
    // UserPasswordEncoderInterface
    public function hashUserPassword(BeforeEntityPersistedEvent $event, UserPasswordHasherInterface  $passwordHasher)
    {
        $entity = $event->getEntityInstance();
        if ($entity instanceof User) {
            // Hash the user's password
            $hashedPassword = $passwordHasher->hashPassword($entity, $entity->getPassword());
            $entity->setPassword($hashedPassword);
        }
    }
}
