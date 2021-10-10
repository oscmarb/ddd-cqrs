<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class DomainEventClassNotExistsException extends DomainException
{
    public function __construct(private string $domainEventClass)
    {
        parent::__construct();
    }

    public function domainEventClass(): string
    {
        return $this->domainEventClass;
    }

    public function errorMessage(): string
    {
        return \sprintf('<%s> domain event class not exists', $this->domainEventClass);
    }
}