<?php

namespace Zored\TelegramBundle\Console;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * We use container-aware command to avoid auto-wiring of API class.
 */
abstract class ConsoleCommand extends ContainerAwareCommand
{

}
