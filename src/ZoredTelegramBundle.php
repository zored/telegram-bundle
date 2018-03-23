<?php

declare(strict_types=1);

namespace Zored\TelegramBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Zored\TelegramBundle\DependencyInjection\ZoredTelegramExtension;

final class ZoredTelegramBundle extends Bundle
{
    public function getContainerExtension(): Extension
    {
        return new ZoredTelegramExtension();
    }
}
