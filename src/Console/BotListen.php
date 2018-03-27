<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zored\TelegramBundle\Telegram\Command\BotListener;

class BotListen extends AbstractConsoleCommand
{
    protected static $defaultName = 'tg:bot:listen';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getBotListener()->listen();
    }

    private function getBotListener(): BotListener
    {
        return $this->getContainer()->get(BotListener::class);
    }
}
