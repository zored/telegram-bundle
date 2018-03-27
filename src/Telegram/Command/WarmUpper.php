<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Telegram\Command;

use Zored\Telegram\TelegramApiInterface;
use Zored\TelegramBundle\Telegram\Command\Exception\WarmUpException;

class WarmUpper
{
    /**
     * @var TelegramApiInterface[]
     */
    private $apis;

    public function __construct(TelegramApiInterface ...$apis)
    {
        $this->apis = $apis;
    }

    public function warmUp(): void
    {
        array_walk($this->apis, [$this, 'warmUpSingle']);
    }

    private function warmUpSingle(TelegramApiInterface $api): void
    {
        if (!$api->getCurrentUser()->getId()) {
            throw WarmUpException::becauseNoCurrentUserFound();
        }
    }
}
