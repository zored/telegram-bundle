<?php

declare(strict_types=1);

namespace Zored\TelegramBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Zored\Telegram\Bot\Update\UpdateHandlerInterface;
use Zored\TelegramBundle\DependencyInjection\ZoredTelegramExtension;
use Zored\TelegramBundle\Telegram\Command\BotListener;
use Zored\TelegramBundle\Tests\DependencyInjection\CompilerPass\FillArgument;

class ZoredTelegramBundle extends Bundle
{
    public function getContainerExtension(): Extension
    {
        return new ZoredTelegramExtension();
    }

    public function build(ContainerBuilder $container): void
    {
        $container
            ->registerForAutoconfiguration(UpdateHandlerInterface::class)
            ->addTag(UpdateHandlerInterface::class)
            ;
        $container->addCompilerPass(new FillArgument(
            BotListener::class,
            '$handlers',
            UpdateHandlerInterface::class
        ));
    }
}
