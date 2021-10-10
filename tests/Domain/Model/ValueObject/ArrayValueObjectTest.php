<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\ArrayValueObject;
use Oscmarb\Ddd\Tests\Test;

final class ArrayValueObjectTest extends Test
{
    public function test_should_return_expected_array_value_object_data(): void
    {
        $array = ['first' => 1, 'second' => 2];
        $valueObject = new ArrayValueObject($array);

        self::assertEquals($array, $valueObject->toPrimitives());
        self::assertEquals($array, $valueObject->value());
        self::assertEquals($valueObject, $valueObject->clone());
        self::assertEquals(\json_encode($array, JSON_THROW_ON_ERROR), $valueObject->toJson());
        self::assertTrue($valueObject->equals($valueObject));
        self::assertFalse($valueObject->equals(ArrayValueObject::empty()));
    }
}