<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\Model;

abstract class ValueObject extends Model
{
    public static function createFromPrimitivesOrNull(mixed $rawData): ?static
    {
        return null === $rawData ? null : static::fromPrimitives($rawData);
    }
}