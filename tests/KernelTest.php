<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests;

use PHPUnit\Framework\TestCase;
use Zored\TelegramBundle\Kernel;
use Zored\TelegramBundle\ZoredTelegramBundle;
use function iterator_to_array;

final class KernelTest extends TestCase
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
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->kernel = new Kernel('prod', false);
    }
}
