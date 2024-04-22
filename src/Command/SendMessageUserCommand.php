<?php

namespace App\Command;

use App\Component\User\UserEmailRead;
use App\Message\GreetingNewUserByEmail;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsCommand(
    name: 'send:message:user',
    description: 'User for sms send',
)]
class SendMessageUserCommand extends Command
{
    public function __construct
    (
        private readonly MessageBusInterface $messageBus,
        private readonly UserEmailRead $emailRead
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($this->emailRead->isIsActive()) {
            $this->messageBus->dispatch(new GreetingNewUserByEmail($this->emailRead->getUserEmail()()));

            $io->success('Foydalanuvchiga xabar yuborildi');
        } else {
            $io->success('Barcha foydalanuvchilarga xabar yuborildi');
        }

        return Command::SUCCESS;
    }
}
