<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

class ArrayValueObject extends ValueObject
{
    public static function empty(): self
    {
        return new self();
    }

    final public function __construct(protected array $value = [])
    {
    }

    public function value(): array
    {
        return $this->value;
    }

    public function toPrimitives(): array
    {
        return $this->value;
    }

    public static function fromPrimitives($data): static
    {
        return new static($data);
    }
}