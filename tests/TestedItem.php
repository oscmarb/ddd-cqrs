<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests;

use Oscmarb\Ddd\Domain\Model\ValueObject\ValueObject;

final class TestedItem extends ValueObject
{
    private string $id;

    public static function create(): self
    {
        return new self((string)\random_int(0, 100));
    }

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public static function fromPrimitives($data): self
    {
        return new self($data['id']);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function toPrimitives(): array
    {
        return ['id' => $this->id];
    }
}