<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\DomainEvent;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEventSubscriber;

final class SyncDomainEventHandlerMock implements DomainEventSubscriber
{
    public function __invoke(): void
    {
    }

    public function isSynchronous(): bool
    {
        return true;
    }

    public static function subscribedTo(): array
    {
        return [DomainEventMock::class];
    }
}