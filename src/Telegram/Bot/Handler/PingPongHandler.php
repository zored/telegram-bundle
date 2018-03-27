<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Bot\Handler;

use Zored\Telegram\Bot\Update\UpdateHandlerInterface;
use Zored\Telegram\Entity\Bot\Update;
use Zored\Telegram\Entity\Bot\Update\UpdateData\Message;
use Zored\Telegram\Entity\Control\Message\MarkdownMessage;
use Zored\Telegram\Entity\Control\Peer\User;
use Zored\Telegram\TelegramApiInterface;

class PingPongHandler implements UpdateHandlerInterface
{
    private const COMMAND = '/ping';

    /**
     * @var TelegramApiInterface
     */
    private $api;

    /**
     * @var int
     */
    private $myId;

    public function __construct(TelegramApiInterface $api)
    {
        $this->api = $api;
        $this->myId = $api->getCurrentUser()->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Update $update): void
    {
        $message = $update->getUpdate()->getMessage();
        if (!$message || $this->myMessage($message) || $this->noCommand($message)) {
            return;
        }

        $this->api->sendMessage(
            new User($message->getFromId()),
            new MarkdownMessage($this->getResponseMessage($message->getMessage()))
        );
    }

    private function myMessage(Message $message): bool
    {
        return $this->myId === $message->getFromId();
    }

    private function noCommand(Message $message): bool
    {
        return 0 !== strpos($message->getMessage(), self::COMMAND);
    }

    private function getResponseMessage(string $requestMessage): string
    {
        $message = substr($requestMessage, \strlen(self::COMMAND));
        $message = trim($message);

        return "**Pong:** $message";
    }
}
