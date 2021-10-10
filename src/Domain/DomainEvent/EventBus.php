<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent;

interface EventBus
{
    public function publish(DomainEvent ...$events): void;
}