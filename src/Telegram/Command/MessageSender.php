<?php

namespace Zored\TelegramBundle\Telegram\Command;

use Zored\Telegram\TelegramApi;
use Zored\TelegramBundle\Service\Client\ApiInterface;
use Zored\TelegramBundle\Telegram\Command\Exception\PeerMessageSendException;

final class MessageSender
{
    /**
     * @var TelegramApi
     */
    private $api;

    public function __construct(TelegramApi $api)
    {
        $this->api = $api;
    }

    /**
     * @throws \Zored\TelegramBundle\Telegram\Command\Exception\PeerMessageSendException
     */
    public function send(string $peer, string $message): void
    {
        // TODO: refactor after peer separation.
        if ($this->toUser($peer, $message)) {
            return;
        }

        if ($this->toChat($peer, $message)) {
            return;
        }

        throw PeerMessageSendException::becauseNoPeerFound($name);
    }

    private function toUser(string $name, string $message): bool
    {
        $user = $this->api->getDialogs()->findUserByFullName($name);
        if (!$user) {
            return false;
        }
        $this->api->sendMessage($user->getId(), $message, TelegramApi::PEER_TYPE_USER);
        return true;
    }

    private function toChat(string $title, string $message): bool
    {
        $chat = $this->api->getDialogs()->findChatByTitle($title);
        if (!$chat) {
            return false;
        }
        $this->api->sendMessage($chat->getId(), $message, TelegramApi::PEER_TYPE_CHAT);
        return true;
    }
}
