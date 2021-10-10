<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Collection;

use InvalidArgumentException;

class Collection implements \Countable, \IteratorAggregate, \ArrayAccess
{
    public static function from(array $elements): static
    {
        return new static($elements);
    }

    public static function empty(): static
    {
        return new static([]);
    }

    final public function __construct(private array $elements)
    {
        $this->assertElements($this->elements);
    }

    protected function type(): ?string
    {
        return null;
    }

    private function assertElements(array $elements): void
    {
        $class = $this->type();

        if (null === $class) {
            return;
        }

        foreach ($elements as $element) {
            if (false === $element instanceof $class) {
                throw new InvalidArgumentException(
                    sprintf('The object <%s> is not an instance of <%s>', $class, $element::class)
                );
            }
        }
    }

    private function assertElement(mixed $element): void
    {
        $this->assertElements([$element]);
    }

    public function set(int|string $key, mixed $element): static
    {
        $this->assertElement($element);
        $this->elements[$key] = $element;

        return $this;
    }

    public function add(mixed $element): static
    {
        $this->assertElement($element);
        $this->elements[] = $element;

        return $this;
    }

    public function get(mixed $key): mixed
    {
        return $this->elements[$key] ?? null;
    }

    public function current(): mixed
    {
        return \current($this->elements);
    }

    public function next(): void
    {
        \next($this->elements);
    }

    public function key(): int|string|null
    {
        return \key($this->elements);
    }

    public function valid(): bool
    {
        return null !== $this->key() && \array_key_exists($this->key(), $this->elements);
    }

    public function rewind(): void
    {
        \reset($this->elements);
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->elements);
    }

    public function containsKey(string|int $key): bool
    {
        return true === isset($this->elements[$key]) || true === array_key_exists($key, $this->elements);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->containsKey($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, mixed $value): void
    {
        if (true === isset($offset)) {
            $this->set($offset, $value);

            return;
        }

        $this->add($value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        $this->remove($offset);
    }

    public function remove(string|int $key): static
    {
        if (true === $this->containsKey($key)) {
            unset($this->elements[$key]);
        }

        return $this;
    }

    public function removeElement(mixed $element): static
    {
        foreach ($this->keys() as $key) {
            if ($element === $this->elements[$key]) {
                unset($this->elements[$key]);
            }
        }

        return $this;
    }

    public function walk(callable $func): static
    {
        \array_walk($this->elements, $func);

        return $this;
    }

    public function filter(callable $func, bool $keepKeys = true): static
    {
        $result = \array_filter($this->elements, $func);

        if (false === $keepKeys) {
            $result = \array_values($result);
        }

        return new static($result);
    }

    public function map(callable $func): static
    {
        return new static(\array_map($func, $this->elements));
    }

    public function reduce(callable $func, mixed $initial): mixed
    {
        return \array_reduce($this->elements, $func, $initial);
    }

    public function sort(callable $func): static
    {
        $elements = $this->elements;
        \usort($elements, $func);

        return new static($elements);
    }

    public function find(callable $func): mixed
    {
        foreach ($this->elements as $key => $element) {
            if (true === $func($key, $element)) {
                return $element;
            }
        }

        return null;
    }

    public function keys(): array
    {
        return \array_keys($this->elements);
    }

    public function values(): array
    {
        return \array_values($this->elements);
    }

    public function exists(callable $func): bool
    {
        foreach ($this->keys() as $key) {
            if (true === $func($key, $this->get($key))) {
                return true;
            }
        }

        return false;
    }

    public function existsValue(callable $func): bool
    {
        foreach ($this->elements as $element) {
            if (true === $func($element)) {
                return true;
            }
        }

        return false;
    }

    public function foreach(callable $func): void
    {
        foreach ($this->elements as $element) {
            $func($element);
        }
    }

    public function isEmpty(): bool
    {
        return 0 === $this->count();
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    public function clone(): static
    {
        return new static($this->elements);
    }

    public function first(): mixed
    {
        foreach ($this->elements as $element) {
            return $element;
        }

        return null;
    }
}
