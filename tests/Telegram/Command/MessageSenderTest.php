<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Command;

use PHPUnit\Framework\TestCase;
use Zored\Telegram\Entity\Bot\Update\ShortSentMessage;
use Zored\Telegram\Entity\Dialogs;
use Zored\Telegram\Entity\User;
use Zored\Telegram\TelegramApiInterface;

final class MessageSenderTest extends TestCase
{
    private $api;

    /**
     * @var MessageSender
     */
    private $sender;

    public function testSend(): void
    {
        $peer = 'bob';
        $message = 'hello';

        $this->api
            ->expects($this->once())
            ->method('getDialogs')
            ->with()
            ->willReturn((new Dialogs())->setUsers([(new User())->setId($id = 1)->setFirstName($peer)]));

        $this->api
            ->expects($this->once())
            ->method('sendMessage')
            ->with(
                $id,
                $message,
                TelegramApiInterface::PEER_TYPE_USER
            )
            ->willReturn(new ShortSentMessage());

        $this->sender->send($peer, $message);
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->sender = new MessageSender(
            $this->api = $this->createMock(TelegramApiInterface::class)
        );
    }
}
