<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent;

interface DomainEventSubscriber
{
    public function isSynchronous(): bool;

    /** @return class-string<DomainEvent>[] */
    public static function subscribedTo(): array;
}