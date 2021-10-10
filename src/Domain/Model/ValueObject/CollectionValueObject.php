<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

use InvalidArgumentException;
use Oscmarb\Ddd\Domain\Serializable;
use Oscmarb\Ddd\Domain\Service\Collection\Collection;

abstract class CollectionValueObject extends ValueObject
{
    protected Collection $collection;

    /**
     * @return class-string<ValueObject>
     */
    abstract protected static function itemsClass(): string;

    public static function empty(): static
    {
        return new static([]);
    }

    public static function fromCollection(Collection $collection): static
    {
        return new static($collection->toArray());
    }

    public static function from(array $items): static
    {
        return new static($items);
    }

    final public function __construct(array $items)
    {
        $this->collection = Collection::from($items);

        $this->assert();
    }

    protected function assert(): void
    {
        $itemsClass = static::itemsClass();

        foreach ($this->toArray() as $item) {
            if (false === $item instanceof $itemsClass) {
                throw new InvalidArgumentException(
                    sprintf('The object <%s> is not an instance of <%s>', $itemsClass, $item::class)
                );
            }
        }
    }

    public function toCollection(): Collection
    {
        return $this->collection->clone();
    }

    public function toArray(): array
    {
        return $this->collection->toArray();
    }

    public function toPrimitives(): array
    {
        return $this->collection->map(static fn(Serializable $item) => $item->toPrimitives())->toArray();
    }

    public static function fromPrimitives($data): static
    {
        $itemsClass = static::itemsClass();

        return self::from($itemsClass::fromMultiplePrimitives($data));
    }
}