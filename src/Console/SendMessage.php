<?php

declare(strict_types=1);

namespace Zored\TelegramBundle\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Zored\TelegramBundle\Telegram\Command\MessageSender;

class SendMessage extends AbstractConsoleCommand
{
    protected static $defaultName = 'tg:client:message';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->addArgument('peer', InputArgument::REQUIRED, 'Chat or user name from your dialog list.');
        $this->addArgument('message', InputArgument::REQUIRED, 'Message to send in Markdown format.');
        $this->setDescription('Send message to user or chat.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getMessageSender()->send(
            $input->getArgument('peer'),
            $input->getArgument('message')
        );
    }

    protected function getMessageSender(): MessageSender
    {
        return $this->getContainer()->get(MessageSender::class);
    }
}
