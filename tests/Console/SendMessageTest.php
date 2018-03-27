<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Console;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Zored\TelegramBundle\Console\SendMessage;
use Zored\TelegramBundle\Telegram\Command\MessageSender;

class SendMessageTest extends TestCase
{
    /**
     * @var SendMessage
     */
    private $sendMessage;

    public function testExecute(): void
    {
        $container = $this->createMock(ContainerInterface::class);
        $container
            ->expects($this->once())
            ->method('get')
            ->with(MessageSender::class)
            ->willReturn($messageSender = $this->createMock(MessageSender::class));

        $this->sendMessage->setContainer($container);
        $input = $this->createMock(InputInterface::class);
        $input
            ->expects($this->exactly(2))
            ->method('getArgument')
            ->willReturn('sample');
        $this->sendMessage->run(
            $input,
            $this->createMock(OutputInterface::class)
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->sendMessage = new SendMessage();
    }
}
