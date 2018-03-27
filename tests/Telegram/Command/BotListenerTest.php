<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Telegram\Command;

use PHPUnit\Framework\TestCase;
use Zored\Telegram\Bot\BotInterface;
use Zored\Telegram\Bot\Update\UpdateHandlerInterface;
use Zored\TelegramBundle\Telegram\Command\BotListener;

final class BotListenerTest extends TestCase
{
    /**
     * @var BotListener
     */
    private $listener;

    private $bot;

    private $handler;

    public function testListen(): void
    {
        $this->bot
            ->expects($this->once())
            ->method('listen')
            ->with([$this->handler]);
        $this->listener->listen();
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->listener = new BotListener(
            $this->bot = $this->createMock(BotInterface::class),
            [$this->handler = $this->createMock(UpdateHandlerInterface::class)]
        );
    }
}
