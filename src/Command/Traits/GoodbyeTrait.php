<?php

declare(strict_types=1);

namespace App\Command\Traits;

use Symfony\Component\Console\Style\SymfonyStyle;

trait GoodbyeTrait
{
    public function seyGoodbye(SymfonyStyle $io): void
    {
        $io->block('Bye-bye');
    }
}
