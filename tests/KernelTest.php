<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Zored\TelegramBundle\Kernel;
use Zored\TelegramBundle\Tests\Tools\CallFirstArgument;
use Zored\TelegramBundle\ZoredTelegramBundle;
use function iterator_to_array;

class KernelTest extends TestCase
{
    /**
     * @var Kernel
     */
    private $kernel;

    public function testGetters(): void
    {
        $this->kernel->getCacheDir();
        $this->kernel->getLogDir();
        $bundles = iterator_to_array($this->kernel->registerBundles());
        $this->assertInstanceOf(ZoredTelegramBundle::class, $bundles[0]);
    }

    /**
     * @covers \Zored\TelegramBundle\Kernel::configureContainer
     * @covers \Zored\TelegramBundle\Kernel::configureRoutes
     */
    public function testProtected(): void
    {
        $loader = $this->createMock(LoaderInterface::class);
        $resolver = $this->createMock(LoaderResolverInterface::class);
        $loader->method('getResolver')->willReturn($resolver);
        $resolver->method('resolve')->willReturn($this->createMock(LoaderInterface::class));
        $loader
            ->expects($this->at(0))
            ->method('load')
            ->with(new CallFirstArgument([
                $this->createMock(ContainerBuilder::class),
            ]));
        $this->kernel->registerContainerConfiguration($loader);
        $this->kernel->loadRoutes($loader);
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->kernel = new Kernel('prod', false);
    }
}
