<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Exception;

abstract class AggregateException extends DomainException
{
    public function __construct(private string $id)
    {
        parent::__construct();
    }

    public function id(): string
    {
        return $this->id;
    }

    abstract public function entityName(): string;
}