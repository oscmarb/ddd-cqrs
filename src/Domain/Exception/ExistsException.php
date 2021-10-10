<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Exception;

abstract class ExistsException extends AggregateException
{
    public function errorCode(): string
    {
        return $this->entityName().'_exists';
    }

    public function errorMessage(): string
    {
        return \sprintf('%s %s already exist', $this->id(), $this->entityName());
    }
}