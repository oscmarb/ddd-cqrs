<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\FloatValueObject;
use Oscmarb\Ddd\Tests\Test;

final class FloatValueObjectTest extends Test
{
    public function test_should_return_float_value_object_data(): void
    {
        $float = (float)\random_int(0, 100);
        $valueObject = new FloatValueObject($float);

        self::assertEquals($float, $valueObject->toPrimitives());
        self::assertEquals($float, $valueObject->value());
        self::assertEquals($valueObject, $valueObject->clone());
        self::assertEquals(\json_encode($float, JSON_THROW_ON_ERROR), $valueObject->toJson());
        self::assertTrue($valueObject->equals($valueObject));
        self::assertFalse($valueObject->equals(new FloatValueObject($float + 1)));
    }
}