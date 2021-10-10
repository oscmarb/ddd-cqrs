<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class InvalidPositiveIntException extends DomainException
{
    public function __construct(private int $value)
    {
        parent::__construct();
    }

    public function value(): int
    {
        return $this->value;
    }

    public function errorMessage(): string
    {
        return sprintf('%s is not a positive int number', $this->value);
    }
}