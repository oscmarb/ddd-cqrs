<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class InvalidPositiveFloatException extends DomainException
{
    public function __construct(private float $value)
    {
        parent::__construct();
    }

    public function value(): float
    {
        return $this->value;
    }

    public function errorMessage(): string
    {
        return sprintf('%s is not a positive float number', $this->value);
    }
}