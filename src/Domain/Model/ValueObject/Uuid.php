<?php

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\Exception\InvalidUuidException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid extends ValueObject
{
    final public function __construct(protected string $value)
    {
        $this->assert();
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public static function uuid(): static
    {
        return new static(self::rawUuid());
    }

    public static function rawUuid(): string
    {
        return RamseyUuid::uuid4()->toString();
    }

    public static function isValid(string $uuid): bool
    {
        return RamseyUuid::isValid($uuid);
    }

    public static function uuidOrException(string $uuid): self
    {
        return new self($uuid);
    }

    protected function assert(): void
    {
        if (false === self::isValid($this->value)) {
            throw new InvalidUuidException($this->value);
        }
    }

    public function toPrimitives(): string
    {
        return $this->value;
    }

    public static function fromPrimitives($data): static
    {
        return new static($data);
    }
}