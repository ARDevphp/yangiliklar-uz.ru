<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserEmailRead
{
    private string $email;
    private bool $isActive;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $manager)
    {
        $users = $userRepository->findBy([], ['createdAt' => 'ASC']);

        foreach ($users as $user) {
            if (!$user->isIsActive()) {
                $this->email = $user->getEmail();
                $this->isActive = true;

                $user->setIsActive($this->isActive);
                $manager->flush();

                return;
            }
        }
    }

    public function getUserEmail(): string
    {
        return $this->email;
    }

    public function isIsActive(): bool
    {
        return $this->isActive;
    }
}
