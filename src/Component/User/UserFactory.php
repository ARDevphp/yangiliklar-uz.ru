<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Entity\User;
use DateTime;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFactory
{
    public function __construct(private UserPasswordHasherInterface $passwordEncoder)
    {
    }

    public function create(string $name, string $email, string $password, bool $isActive): User
    {
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setCreatedAt(new DateTime());
        $user->setIsActive($isActive);
        $user->setPassword($this->passwordEncoder->hashPassword($user, $password));

        return $user;
    }
}
