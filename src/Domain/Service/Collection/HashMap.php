<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Collection;

use Oscmarb\Ddd\Domain\Service\Utils\HashService;

final class HashMap
{
    public static function empty(): self
    {
        return new self([], []);
    }

    public static function fromArray(array $data): self
    {
        $keys = \array_keys($data);
        $keysHash = \array_map(static fn($key) => self::hashKey($key), $keys);

        return new self(
            \array_combine($keysHash, $keys),
            \array_combine($keysHash, \array_values($data))
        );
    }

    private function __construct(private array $keys, private array $values)
    {
    }

    public function put(mixed $key, mixed $value): void
    {
        $hash = self::hashKey($key);

        $this->keys[$hash] = $key;
        $this->values[$hash] = $value;
    }

    public function remove(mixed $key): void
    {
        $hash = self::hashKey($key);

        if (false === isset($this->keys[$hash])) {
            return;
        }

        unset($this->keys[$hash], $this->values[$hash]);
    }

    public function removeAll(array $keys): void
    {
        foreach ($keys as $key) {
            $this->remove($key);
        }
    }

    public function keys(): array
    {
        return \array_values($this->keys);
    }

    public function values(): array
    {
        return \array_values($this->values);
    }

    public function get(mixed $key): mixed
    {
        return $this->values[self::hashKey($key)] ?? null;
    }

    public function toArray(): array
    {
        return \array_combine($this->keys(), $this->values());
    }

    public function size(): int
    {
        return count($this->values);
    }

    public static function hashKey(mixed $key): string
    {
        return HashService::newInstance()->calculateHash($key);
    }
}