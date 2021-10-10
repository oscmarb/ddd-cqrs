<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date;

use Oscmarb\Ddd\Domain\Service\Date\Exception\InvalidDateIntervalUnitException;

final class DateIntervalFactory
{
    public const SECONDS = 'seconds';
    public const MINUTES = 'minutes';
    public const HOURS = 'hours';
    public const DAYS = 'days';
    public const WEEKS = 'weeks';
    public const MONTHS = 'months';
    public const YEARS = 'years';

    public static function seconds(int $seconds): \DateInterval
    {
        return self::create($seconds, self::SECONDS);
    }

    public static function second(): \DateInterval
    {
        return self::create(1, self::SECONDS);
    }

    public static function minutes(int $minutes): \DateInterval
    {
        return self::create($minutes, self::MINUTES);
    }

    public static function minute(): \DateInterval
    {
        return self::create(1, self::MINUTES);
    }

    public static function hours(int $hours): \DateInterval
    {
        return self::create($hours, self::HOURS);
    }

    public static function hour(): \DateInterval
    {
        return self::create(1, self::HOURS);
    }

    public static function days(int $days): \DateInterval
    {
        return self::create($days, self::DAYS);
    }

    public static function day(): \DateInterval
    {
        return self::create(1, self::DAYS);
    }

    public static function weeks(int $weeks): \DateInterval
    {
        return self::create($weeks, self::WEEKS);
    }

    public static function week(): \DateInterval
    {
        return self::create(1, self::WEEKS);
    }

    public static function months(int $months): \DateInterval
    {
        return self::create($months, self::MONTHS);
    }

    public static function month(): \DateInterval
    {
        return self::create(1, self::MONTHS);
    }

    public static function years(int $years): \DateInterval
    {
        return self::create($years, self::YEARS);
    }

    public static function year(): \DateInterval
    {
        return self::create(1, self::YEARS);
    }

    public static function create(int $datetime, string $unit): \DateInterval
    {
        self::assertUnit($unit);

        return \DateInterval::createFromDateString(\sprintf('%s %s', $datetime, $unit));
    }

    private static function assertUnit(string $unit): void
    {
        if (false === self::isValidUnit($unit)) {
            throw new InvalidDateIntervalUnitException($unit);
        }
    }

    public static function isValidUnit(string $unit): bool
    {
        return true === \in_array($unit, self::allUnits());
    }

    private static function allUnits(): array
    {
        return [
            self::SECONDS,
            self::MINUTES,
            self::HOURS,
            self::DAYS,
            self::WEEKS,
            self::MONTHS,
            self::YEARS,
        ];
    }
}