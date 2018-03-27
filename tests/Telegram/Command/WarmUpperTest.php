<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Telegram\Command;

use PHPUnit\Framework\TestCase;
use Zored\Telegram\Entity\User;
use Zored\Telegram\TelegramApiInterface;
use Zored\TelegramBundle\Telegram\Command\WarmUpper;

class WarmUpperTest extends TestCase
{
    /**
     * @var WarmUpper
     */
    private $warmUpper;

    private $api;

    /**
     * @expectedException \Zored\TelegramBundle\Telegram\Command\Exception\WarmUpException
     */
    public function testWarmUpNoId(): void
    {
        $this->warmUpper->warmUp();
    }

    public function testWarmUp(): void
    {
        $this->doesNotPerformAssertions();
        $user = $this->createMock(User::class);
        $this->api
            ->expects($this->once())
            ->method('getCurrentUser')
            ->with()
            ->willReturn($user);
        $user
            ->expects($this->once())
            ->method('getId')
            ->with()
            ->willReturn(1);

        $this->warmUpper->warmUp();
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->warmUpper = new WarmUpper($this->api = $this->createMock(TelegramApiInterface::class));
    }
}
