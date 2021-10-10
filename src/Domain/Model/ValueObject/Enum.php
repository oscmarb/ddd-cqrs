<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Service\Utils\Utils;

abstract class Enum extends ValueObject
{
    protected static array $cache = [];
    protected mixed $value;

    final public function __construct(mixed $value)
    {
        $this->value = $value;

        $this->assert();
    }

    protected function assert(): void
    {
        if (false === in_array($this->value, static::values(), true)) {
            $this->throwExceptionForInvalidValue();
        }
    }

    protected function throwExceptionForInvalidValue(): void
    {
        throw new \InvalidArgumentException(
            \sprintf(
                '<%s> not allowed value, allowed values: <%s> for enum class <%s>',
                $this->value,
                \implode(' ', self::values()),
                static::class,
            ),
        );
    }

    public static function __callStatic(string $name, mixed $args): static
    {
        return new static(self::values()[$name]);
    }

    public static function from(mixed $value): static
    {
        return new static($value);
    }

    public static function values(): array
    {
        $class = static::class;

        if (false === isset(self::$cache[$class])) {
            $reflected = new \ReflectionClass($class);
            self::$cache[$class] = Utils::reindex(self::keysFormatter(), $reflected->getConstants());
        }

        return self::$cache[$class];
    }

    private static function keysFormatter(): callable
    {
        return static fn($unused, string $key): string => Utils::toCamelCase(strtolower($key));
    }

    public function value(): mixed
    {
        return $this->value;
    }

    public static function fromPrimitives(mixed $data): static
    {
        return new static($data);
    }

    public function toPrimitives(): mixed
    {
        return $this->value;
    }
}