<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\DomainEvent;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;

final class DomainEventMock extends DomainEvent
{
    public static function eventName(): string
    {
        return 'event_mock';
    }

    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): self
    {
        return new self($messageId, $messageOccurredOn);
    }

    public function toPrimitives(): array
    {
        return [];
    }
}