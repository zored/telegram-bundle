<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Command;

use Zored\Telegram\Bot\BotInterface;
use Zored\Telegram\Bot\Update\UpdateHandlerInterface;

class BotListener
{
    /**
     * @var BotInterface
     */
    private $bot;

    /**
     * @var UpdateHandlerInterface[]
     */
    private $handlers;

    /**
     * @param UpdateHandlerInterface[] $handlers
     */
    public function __construct(BotInterface $bot, array $handlers)
    {
        $this->bot = $bot;
        $this->handlers = $handlers;
    }

    public function listen(): void
    {
        $this->bot->listen($this->handlers);
    }
}
