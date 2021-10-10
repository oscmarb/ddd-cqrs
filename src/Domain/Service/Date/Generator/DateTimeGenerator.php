<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date\Generator;

use Oscmarb\Ddd\Domain\Service\Date\DateIntervalFactory;
use Oscmarb\Ddd\Domain\Service\Date\DateUtils;

final class DateTimeGenerator implements DateGenerator
{
    public static function now(?string $timezone = null): \DateTimeImmutable
    {
        return new \DateTimeImmutable('now', self::getTimeZone($timezone));
    }

    public static function nowSub(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable
    {
        return self::now($timezone)->sub($interval);
    }

    public static function nowAdd(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable
    {
        return self::now($timezone)->add($interval);
    }

    public static function yesterday(?string $timezone = null): \DateTimeImmutable
    {
        return self::clearTime(self::nowSub(DateIntervalFactory::day(), $timezone));
    }

    public static function tomorrow(?string $timezone = null): \DateTimeImmutable
    {
        return self::clearTime(self::nowAdd(DateIntervalFactory::day(), $timezone));
    }

    private static function getTimeZone(?string $timezone): \DateTimeZone
    {
        return new \DateTimeZone($timezone ?? DateUtils::DEFAULT_TIME_ZONE);
    }

    private static function clearTime(\DateTimeImmutable $date): \DateTimeImmutable
    {
        return $date->setTime(0, 0);
    }
}