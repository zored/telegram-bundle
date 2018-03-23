<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Command\Exception;

final class PeerMessageSendException extends \RuntimeException
{
    public static function becauseNoPeerFound(string $name): self
    {
        return new self("No peer found with name '$name'.");
    }
}
