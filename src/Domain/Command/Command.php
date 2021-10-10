<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Command;

use Oscmarb\Ddd\Domain\Message\Message;

abstract class Command extends Message
{
    public function __construct(?string $commandId = null, ?string $commandOccurredOn = null)
    {
        parent::__construct(Message::COMMAND_TYPE, $commandId, $commandOccurredOn);
    }

    public function messageName(): string
    {
        return static::commandName();
    }

    abstract public static function commandName(): string;
}