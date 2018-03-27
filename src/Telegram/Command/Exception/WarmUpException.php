<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Command\Exception;

class WarmUpException extends \RuntimeException
{
    public static function becauseNoCurrentUserFound(): self
    {
        return new self('No current user found for one of APIs.');
    }
}
