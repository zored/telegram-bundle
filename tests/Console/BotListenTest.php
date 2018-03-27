<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Console;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Zored\TelegramBundle\Console\BotListen;
use Zored\TelegramBundle\Telegram\Command\BotListener;

final class BotListenTest extends TestCase
{
    /**
     * @var BotListen
     */
    private $command;

    public function testRun(): void
    {
        $container = $this->createMock(ContainerInterface::class);
        $container
            ->expects($this->once())
            ->method('get')
            ->with(BotListener::class)
            ->willReturn($botListener = $this->createMock(BotListener::class));

        $this->command->setContainer($container);
        $this->command->run(
            $this->createMock(InputInterface::class),
            $this->createMock(OutputInterface::class)
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->command = new BotListen();
    }
}
