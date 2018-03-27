<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Zored\TelegramBundle\DependencyInjection\ZoredTelegramExtension;

class ZoredTelegramExtensionTest extends TestCase
{
    /**
     * @var ZoredTelegramExtension
     */
    private $extension;

    public function testLoad(): void
    {
        $container = $this->createMock(ContainerBuilder::class);
        $parameterBag = $this->createMock(ParameterBagInterface::class);
        $container
            ->method('getParameterBag')
            ->with()
            ->willReturn($parameterBag);
        $parameterBag
            ->method('unescapeValue')
            ->with()
            ->willReturn('services.yaml');
        $this->extension->load($configs = [], $container);
        $this->assertTrue(true);
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->extension = new ZoredTelegramExtension();
    }
}
