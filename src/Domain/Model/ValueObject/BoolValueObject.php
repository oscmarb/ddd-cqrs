<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

class BoolValueObject extends ValueObject
{
    final public function __construct(protected bool $value)
    {
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function toPrimitives(): bool
    {
        return $this->value;
    }

    public static function fromPrimitives($data): static
    {
        return new static($data);
    }
}