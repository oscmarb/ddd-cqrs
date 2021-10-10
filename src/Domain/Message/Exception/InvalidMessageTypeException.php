<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Message\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class InvalidMessageTypeException extends DomainException
{
    public function __construct(private string $type)
    {
        parent::__construct();
    }

    public function type(): string
    {
        return $this->type;
    }

    public function errorMessage(): string
    {
        return sprintf('%s is not a valid message type', $this->type);
    }
}