<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Console;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Zored\TelegramBundle\Console\WarmUp;
use Zored\TelegramBundle\Telegram\Command\WarmUpper;

class WarmUpTest extends TestCase
{
    /**
     * @var WarmUp
     */
    private $warmUp;

    public function testExecute(): void
    {
        $container = $this->createMock(ContainerInterface::class);
        $container
            ->expects($this->once())
            ->method('get')
            ->with(WarmUpper::class)
            ->willReturn($warmUpper = $this->createMock(WarmUpper::class));

        $this->warmUp->setContainer($container);
        $input = $this->createMock(InputInterface::class);
        $this->warmUp->run(
            $input,
            $this->createMock(OutputInterface::class)
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->warmUp = new WarmUp();
    }
}
