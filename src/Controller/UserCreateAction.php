<?php

declare(strict_types=1);

namespace App\Controller;

use App\Component\User\Dtos\UserDto;
use App\Component\User\UserFactory;
use App\Component\User\UserManager;
use App\Controller\Base\AbstractController;
use App\Entity\User;
use App\Message\GreetingNewUserByEmail;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class CreateUserController
 *
 * @package App\Controller
 */
class UserCreateAction extends AbstractController
{
    public function __invoke(
        MessageBusInterface $messageBus,
        UserFactory $userFactory,
        UserManager $userManager,
        User $data
    ): User
    {
        $this->validate($data);

        $message = new GreetingNewUserByEmail($data->getEmail());
        $messageBus->dispatch($message);

        $user = $userFactory->create($data->getName(), $data->getEmail(), $data->getPassword(), false);
        $userManager->save($user, true);

        return $user;
    }
}
