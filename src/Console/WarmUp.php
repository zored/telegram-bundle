<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zored\TelegramBundle\Telegram\Command\WarmUpper;

final class WarmUp extends ConsoleCommand
{
    protected static $defaultName = 'warmup';

    protected function configure(): void
    {
        $this->setDescription('Warm-up telegram sessions.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getWarmUpper()->warmUp();
    }

    protected function getWarmUpper(): WarmUpper
    {
        return $this->getContainer()->get(WarmUpper::class);
    }
}
