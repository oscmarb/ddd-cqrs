<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model;

use Oscmarb\Ddd\Domain\Cloneable;
use Oscmarb\Ddd\Domain\Deserializable;
use Oscmarb\Ddd\Domain\Serializable;
use Oscmarb\Ddd\Domain\Service\Utils\Utils;

abstract class Model implements Serializable, Deserializable, Cloneable
{
    /** @var ?static */
    private $snapshot = null;

    public function toJson(): string
    {
        return \json_encode($this->toPrimitives(), JSON_THROW_ON_ERROR);
    }

    public static function fromJson(string $json): static
    {
        return static::fromPrimitives(\json_decode($json, true, 512, JSON_THROW_ON_ERROR));
    }

    public function equals(mixed $item): bool
    {
        return true === $item instanceof $this && $this->toJson() === $item->toJson();
    }

    public function clone(): static
    {
        return static::fromPrimitives($this->toPrimitives());
    }

    public static function fromMultiplePrimitives(array $items): array
    {
        return \array_map(static fn($data) => static::fromPrimitives($data), $items);
    }

    public function snapshot(): static
    {
        return $this->clone();
    }

    protected function takeSnapshot(): void
    {
        $this->snapshot = $this->snapshot();
    }

    protected function haveBeenUpdated(array $ignoreAttributes = []): bool
    {
        if (null === $this->snapshot) {
            return true;
        }

        $plainSnapshot = $this->snapshot->toPrimitives();

        return true === \is_array($plainSnapshot)
            ? Utils::areArraysEquals($this->toPrimitives(), $plainSnapshot, $ignoreAttributes)
            : $this->equals($this->snapshot);
    }
}