<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent;

use Oscmarb\Ddd\Domain\Message\Message;

abstract class DomainEvent extends Message
{
    public function __construct(?string $eventId = null, ?string $eventOccurredOn = null)
    {
        parent::__construct(Message::DOMAIN_EVENT_TYPE, $eventId, $eventOccurredOn);
    }

    abstract public static function eventName(): string;

    public function messageName(): string
    {
        return static::eventName();
    }
}