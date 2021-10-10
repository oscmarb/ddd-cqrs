<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Service\Date;

use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Domain\Service\Date\DateUtils;
use Oscmarb\Ddd\Tests\Domain\Service\Date\Generator\DateGeneratorMock;
use Oscmarb\Ddd\Tests\Test;

final class DateServiceTest extends Test
{
    public function test_should_return_expected_data(): void
    {
        Clock::clear();

        $date = new \DateTimeImmutable();
        DateGeneratorMock::setNextDate($date);
        Clock::create(new DateGeneratorMock());

        self::assertTrue(Clock::isInstantiated());
        self::assertEquals($date, Clock::now());
        self::assertEquals($date, Clock::tomorrow());
        self::assertEquals($date, Clock::yesterday());
        self::assertEquals(DateUtils::dateToString($date), Clock::formattedNow());
    }
}