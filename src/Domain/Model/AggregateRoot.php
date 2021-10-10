<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;

abstract class AggregateRoot extends Entity
{
    private array $domainEvents = [];

    final protected function record(DomainEvent $domainEvent): void
    {
        $this->domainEvents[] = $domainEvent;
    }

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }
}