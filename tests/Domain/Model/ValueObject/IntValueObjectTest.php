<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\IntValueObject;
use Oscmarb\Ddd\Tests\Test;

final class IntValueObjectTest extends Test
{
    public function test_should_return_int_value_object_data(): void
    {
        $int = \random_int(0, 100);
        $valueObject = new IntValueObject($int);

        self::assertEquals($int, $valueObject->toPrimitives());
        self::assertEquals($int, $valueObject->value());
        self::assertEquals($valueObject, $valueObject->clone());
        self::assertEquals(\json_encode($int, JSON_THROW_ON_ERROR), $valueObject->toJson());
        self::assertTrue($valueObject->equals($valueObject));
        self::assertFalse($valueObject->equals(new IntValueObject($int + 1)));
    }
}