<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\Exception\InvalidPositiveFloatException;

class PositiveFloatValueObject extends ValueObject
{
    final public function __construct(protected float $value)
    {
        $this->assert();
    }

    public function value(): float
    {
        return $this->value;
    }

    public function toPrimitives(): float
    {
        return $this->value;
    }

    public static function fromPrimitives($data): static
    {
        return new static($data);
    }

    protected function assert(): void
    {
        if (false === self::isValid($this->value)) {
            throw new InvalidPositiveFloatException($this->value);
        }
    }

    public static function isValid(float $value): bool
    {
        return $value >= 0;
    }
}