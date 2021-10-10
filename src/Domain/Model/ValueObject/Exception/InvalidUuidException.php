<?php

namespace Oscmarb\Ddd\Domain\Model\ValueObject\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class InvalidUuidException extends DomainException
{
    public function __construct(private string $uuid)
    {
        parent::__construct();
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function errorMessage(): string
    {
        return sprintf('Uuid %s is invalid.', $this->uuid);
    }
}