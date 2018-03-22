<?php

namespace Zored\TelegramBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Zored\TelegramBundle\DependencyInjection\ZoredTelegramExtension;

final class ZoredTelegramBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new ZoredTelegramExtension();
    }
}
