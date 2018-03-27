<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Telegram\Command;

use PHPUnit\Framework\TestCase;
use Zored\Telegram\Entity\Bot\Update\ShortSentMessage;
use Zored\Telegram\Entity\Control\Message\MarkdownMessage;
use Zored\Telegram\Entity\Control\Peer\User;
use Zored\Telegram\Entity\Dialogs;
use Zored\Telegram\Entity\User as EntityUser;
use Zored\Telegram\TelegramApiInterface;
use Zored\TelegramBundle\Telegram\Command\MessageSender;

class MessageSenderTest extends TestCase
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
            ->willReturn(
                (new Dialogs())
                    ->setUsers([
                        (new EntityUser())
                            ->setId($id = 1)
                            ->setFirstName($peer),
                    ])
            );

        $this->api
            ->expects($this->once())
            ->method('sendMessage')
            ->with(
                new User($id),
                new MarkdownMessage($message)
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
