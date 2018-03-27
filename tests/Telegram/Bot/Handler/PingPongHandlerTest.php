<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Telegram\Bot\Handler;

use PHPUnit\Framework\TestCase;
use Zored\Telegram\Entity\Bot\Update;
use Zored\Telegram\Entity\Bot\Update\UpdateData;
use Zored\Telegram\Entity\Bot\Update\UpdateData\Message;
use Zored\Telegram\Entity\Control\Message\MarkdownMessage;
use Zored\Telegram\Entity\Control\Peer\User;
use Zored\Telegram\TelegramApiInterface;
use Zored\TelegramBundle\Telegram\Bot\Handler\PingPongHandler;

final class PingPongHandlerTest extends TestCase
{
    private const USER_ID = 1;

    /**
     * @var PingPongHandler
     */
    private $handler;

    private $api;

    public function testHandle(): void
    {
        $update = $this->createMock(Update::class);
        $update
            ->expects($this->once())
            ->method('getUpdate')
            ->with()
            ->willReturn($updateData = $this->createMock(UpdateData::class));
        $updateData
            ->expects($this->once())
            ->method('getMessage')
            ->with()
            ->willReturn($message = $this->createMock(Message::class));
        $message
            ->expects($this->exactly(2))
            ->method('getMessage')
            ->willReturn('/ping hello');

        $this->api
            ->expects($this->once())
            ->method('sendMessage')
            ->with(new User(0), new MarkdownMessage('**Pong:** hello'));
        $this->handler->handle($update);
    }

    public function testHandleMyMessage(): void
    {
        $update = $this->createMock(Update::class);
        $update
            ->expects($this->once())
            ->method('getUpdate')
            ->willReturn($updateData = $this->createMock(UpdateData::class));
        $updateData
            ->expects($this->once())
            ->method('getMessage')
            ->willReturn($message = $this->createMock(Message::class));
        $message
            ->expects($this->once())
            ->method('getMessage')
            ->willReturn('hello');

        $this->api->expects($this->never())->method('sendMessage');
        $this->handler->handle($update);
    }

    public function testHandleNoCommand(): void
    {
        $update = $this->createMock(Update::class);
        $update
            ->expects($this->once())
            ->method('getUpdate')
            ->willReturn($updateData = $this->createMock(UpdateData::class));
        $updateData
            ->expects($this->once())
            ->method('getMessage')
            ->willReturn($message = $this->createMock(Message::class));
        $message
            ->expects($this->once())
            ->method('getFromId')
            ->willReturn(self::USER_ID);

        $this->api->expects($this->never())->method('sendMessage');
        $this->handler->handle($update);
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->api = $this->createMock(TelegramApiInterface::class);
        $this->api
            ->expects($this->once())
            ->method('getCurrentUser')
            ->with()
            ->willReturn($user = $this->createMock(\Zored\Telegram\Entity\User::class));
        $user
            ->expects($this->once())
            ->method('getId')
            ->with()
            ->willReturn(self::USER_ID);
        $this->handler = new PingPongHandler($this->api);
    }
}
