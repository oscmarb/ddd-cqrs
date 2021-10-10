<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

class IntValueObject extends ValueObject
{
    final public function __construct(protected int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }

    public function toPrimitives(): int
    {
        return $this->value;
    }

    public static function fromPrimitives($data): static
    {
        return new static($data);
    }
}