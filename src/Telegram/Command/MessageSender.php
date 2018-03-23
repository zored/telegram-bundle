<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Command;

use Zored\Telegram\Entity\Control\Message\MarkdownMessage;
use Zored\Telegram\Entity\Control\Peer\PeerFactory;
use Zored\Telegram\TelegramApiInterface;

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
     * @throws \Zored\TelegramBundle\Telegram\Command\Exception\PeerMessageSendException
     */
    public function send(string $search, string $messageContent): void
    {
        $dialogs = $this->api->getDialogs();
        $this->api->sendMessage(PeerFactory::createByEntity(
            $dialogs->findUserByFullName($search) ??
            $dialogs->findChatByTitle($search)
        ), new MarkdownMessage($messageContent));
    }
}
