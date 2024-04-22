<?php

namespace App\Command;

use App\Command\Traits\GoodbyeTrait;
use App\Command\Traits\GreetingTrait;
use App\Command\Traits\RunCommandTrait;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'lesson:file:create',
    description: 'Add a short description for your command'
)]

class LessonFileCreateCommand extends Command
{
    use GreetingTrait;
    use GoodbyeTrait;
    protected function configure(): void
    {
        $this->addArgument('text', InputArgument::REQUIRED, 'File text')->addOption('append', 'a', InputOption::VALUE_NONE, 'Append text to file');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $text = $input->getArgument('text');
        $operator = $input->getOption('append') ? '>>' : '>';
        $this->seyHello($io);

        $result = system("echo '$text' $operator /tmp/foo.txt");

        if ($result === false) {
            $io->error('Undefined error. Maybe you have not access to edit the file');
            return Command::FAILURE;
        }

        $io->success('File is updated!');
        $this->seyGoodbye($io);

        return Command::SUCCESS;
    }
}