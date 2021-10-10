<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Service\Date\Generator;

use Oscmarb\Ddd\Domain\Service\Date\Generator\DateGenerator;

final class DateGeneratorMock implements DateGenerator
{
    private static ?\DateTimeImmutable $date;

    public static function setNextDate(\DateTimeImmutable $date): void
    {
        self::$date = $date;
    }

    public static function now(?string $timezone = null): \DateTimeImmutable
    {
        return self::nextDate();
    }

    public static function yesterday(?string $timezone = null): \DateTimeImmutable
    {
        return self::nextDate();
    }

    public static function tomorrow(?string $timezone = null): \DateTimeImmutable
    {
        return self::nextDate();
    }

    public static function nowSub(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable
    {
        return self::nextDate();
    }

    public static function nowAdd(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable
    {
        return self::nextDate();
    }

    private static function nextDate(): \DateTimeImmutable
    {
        return self::$date ?? new \DateTimeImmutable();
    }
}