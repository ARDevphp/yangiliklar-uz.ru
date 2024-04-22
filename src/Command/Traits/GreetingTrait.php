<?php

declare(strict_types=1);

namespace App\Command\Traits;

use Symfony\Component\Console\Style\SymfonyStyle;

trait GreetingTrait
{
    public function seyHello(SymfonyStyle $io): void
    {
        $io->warning('Welcome to Symfony Framework');
    }
}
