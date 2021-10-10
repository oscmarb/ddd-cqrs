<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Service\Date;

use Oscmarb\Ddd\Domain\Service\Date\DateUtils;
use Oscmarb\Ddd\Tests\Test;

final class DateUtilsTest extends Test
{
    public function test_should_return_expected_data(): void
    {
        $formattedDate = '2019-07-17T09:50:35+00:00';
        $dateTime = \DateTime::createFromFormat(\DateTimeInterface::ATOM, $formattedDate);
        $immutableDateTime = \DateTimeImmutable::createFromMutable($dateTime);

        self::assertEquals($formattedDate, DateUtils::dateToString($dateTime));
        self::assertEquals($immutableDateTime, DateUtils::stringToImmutable($formattedDate));
        self::assertEquals($immutableDateTime, DateUtils::immutableFromDateTime($dateTime));
        self::assertEquals($dateTime, DateUtils::stringToDateTime($formattedDate));
        self::assertEquals($dateTime, DateUtils::dateTimeFromImmutable($immutableDateTime));
    }
}