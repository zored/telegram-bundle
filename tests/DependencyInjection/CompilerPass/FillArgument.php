<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class FillArgument implements CompilerPassInterface
{
    /**
     * @var string
     */
    private $service;

    /**
     * @var string
     */
    private $argument;

    /**
     * @var string
     */
    private $tag;

    public function __construct(string $service, string $argument, string $tag)
    {
        $this->service = $service;
        $this->argument = $argument;
        $this->tag = $tag;
    }

    public function process(ContainerBuilder $container): void
    {
        $service = $container->findDefinition($this->service);
        $tagged = $container->findTaggedServiceIds($this->tag);
        $itemIds = array_keys($tagged);
        $references = array_map(function (string $id): Reference {
            return new Reference($id);
        }, $itemIds);
        $service->setArgument($this->argument, $references);
    }
}
