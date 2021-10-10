<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Utils;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEventSubscriber;

final class CallableFirstParameterExtractor
{
    public static function forCallables(iterable $callables): array
    {
        $indexedCallables = [];

        foreach ($callables as $callable) {
            $indexes = self::extractIndexesFromCallable($callable);

            if (true === empty($indexes)) {
                continue;
            }

            foreach ($indexes as $index) {
                $indexedCallables[$index][] = $callable;
            }
        }

        return $indexedCallables;
    }

    private static function extractIndexesFromCallable(callable $callable): array
    {
        if (true === $callable instanceof DomainEventSubscriber) {
            return $callable::subscribedTo();
        }

        $class = self::extract($callable);

        return null === $class ? [] : [$class];
    }

    private static function extract(mixed $className): ?string
    {
        $reflector = new \ReflectionClass($className);
        $method = $reflector->getMethod('__invoke');

        if (1 !== $method->getNumberOfParameters()) {
            return null;
        }

        $parameterType = $method->getParameters()[0]->getType();

        /** @phpstan-ignore-next-line */
        return null === $parameterType ? null : $parameterType->getName();
    }
}