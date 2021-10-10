<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent;

interface EventDispatcher
{
    public function dispatch(DomainEvent ...$events): void;
}