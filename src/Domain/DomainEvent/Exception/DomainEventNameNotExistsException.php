<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class DomainEventNameNotExistsException extends DomainException
{
    public function __construct(private string $domainEventName)
    {
        parent::__construct();
    }

    public function domainEventName(): string
    {
        return $this->domainEventName;
    }

    public function errorMessage(): string
    {
        return \sprintf('<%s> domain event name not exists', $this->domainEventName);
    }
}