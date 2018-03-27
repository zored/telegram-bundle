<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zored\TelegramBundle\ZoredTelegramBundle;

class ZoredTelegramBundleTest extends TestCase
{
    /**
     * @var ZoredTelegramBundle
     */
    private $bundle;

    public function testGetters(): void
    {
        $this->bundle->getContainerExtension();
        $this->assertTrue(true, 'doesNotPerformAssertions()');
    }

    public function testBuild(): void
    {
        $container = $this->createMock(ContainerBuilder::class);
        $container
            ->expects($this->once())
            ->method('registerForAutoconfiguration')
            ->with()
            ->willReturn($this->createMock(ChildDefinition::class));
        $container->expects($this->once())->method('addCompilerPass');
        $this->bundle->build($container);
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->bundle = new ZoredTelegramBundle();
    }
}
