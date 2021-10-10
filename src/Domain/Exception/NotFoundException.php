<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Exception;

abstract class NotFoundException extends AggregateException
{
    public function errorCode(): string
    {
        return $this->entityName().'_not_found';
    }

    public function errorMessage(): string
    {
        return \sprintf('%s %s does not exist', $this->id(), $this->entityName());
    }
}