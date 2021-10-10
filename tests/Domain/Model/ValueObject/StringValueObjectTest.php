<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\StringValueObject;
use Oscmarb\Ddd\Tests\Test;

final class StringValueObjectTest extends Test
{
    public function test_should_return_string_value_object_data(): void
    {
        $string = 'aString';
        $valueObject = new StringValueObject($string);

        self::assertEquals($string, $valueObject->toPrimitives());
        self::assertEquals($string, $valueObject->value());
        self::assertEquals($valueObject, $valueObject->clone());
        self::assertEquals(\json_encode($string, JSON_THROW_ON_ERROR), $valueObject->toJson());
        self::assertTrue($valueObject->equals($valueObject));
        self::assertFalse($valueObject->equals(new StringValueObject('otherString')));
    }
}