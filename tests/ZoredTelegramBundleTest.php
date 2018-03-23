<?php

declare(strict_types=1);

namespace Zored\TelegramBundle;

use PHPUnit\Framework\TestCase;

final class ZoredTelegramBundleTest extends TestCase
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

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->bundle = new ZoredTelegramBundle();
    }
}
