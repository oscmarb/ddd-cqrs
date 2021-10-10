<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\DateTimeValueObject;
use Oscmarb\Ddd\Domain\Service\Date\DateIntervalFactory;
use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Domain\Service\Date\DateUtils;
use Oscmarb\Ddd\Tests\Test;

final class DateTimeValueObjectTest extends Test
{
    public function test_should_return_date_time_value_object_data(): void
    {
        $formattedDate = Clock::formattedNow();
        $otherFormattedDate = DateUtils::dateToString(
            DateUtils::stringToImmutable($formattedDate)->add(DateIntervalFactory::day())
        );
        $valueObject = new DateTimeValueObject($formattedDate);

        self::assertEquals($formattedDate, $valueObject->toPrimitives());
        self::assertEquals($formattedDate, $valueObject->value());
        self::assertEquals($valueObject, $valueObject->clone());
        self::assertEquals(\json_encode($formattedDate, JSON_THROW_ON_ERROR), $valueObject->toJson());
        self::assertTrue($valueObject->equals($valueObject));
        self::assertFalse($valueObject->equals(new DateTimeValueObject($otherFormattedDate)));
    }
}