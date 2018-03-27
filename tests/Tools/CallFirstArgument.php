<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Tests\Tools;

use PHPUnit\Framework\Constraint\Callback;
use function call_user_func_array;

class CallFirstArgument extends Callback
{
    public function __construct(array $arguments = [])
    {
        parent::__construct(function (callable $callable) use ($arguments): bool {
            call_user_func_array($callable, $arguments);

            return true;
        });
    }
}
