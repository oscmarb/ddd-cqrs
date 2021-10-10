<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;


class FloatValueObject extends ValueObject
{
    final public function __construct(protected float $value)
    {
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
}