<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Command;

use Zored\Telegram\Entity\Control\Message\MarkdownMessage;
use Zored\Telegram\Entity\Control\Peer\PeerFactory;
use Zored\Telegram\Entity\Control\Peer\PeerInterface;
use Zored\Telegram\TelegramApiInterface;
use Zored\TelegramBundle\Telegram\Command\Exception\PeerMessageSendException;

final class MessageSender
{
    /**
     * @var TelegramApiInterface
     */
    private $api;

    public function __construct(TelegramApiInterface $api)
    {
        $this->api = $api;
    }

    /**
     * @throws PeerMessageSendException
     */
    public function send(string $search, string $messageContent): void
    {
        $this->api->sendMessage(
            $this->findPeer($search),
            new MarkdownMessage($messageContent)
        );
    }

    /**
     * @throws PeerMessageSendException
     */
    private function findPeer(string $search): PeerInterface
    {
        $dialogs = $this->api->getDialogs();

        return PeerFactory::createByEntity(
            $dialogs->findUserByFullName($search) ??
            $dialogs->findChatByTitle($search)
        );
    }
}
