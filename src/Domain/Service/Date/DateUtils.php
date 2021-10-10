<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date;

use Oscmarb\Ddd\Domain\Service\Date\Exception\InvalidDateException;
use Oscmarb\Ddd\Domain\Service\Date\Exception\InvalidDateInstanceException;

final class DateUtils
{
    public const DEFAULT_TIME_ZONE = "UTC";
    public const DEFAULT_FORMAT = \DateTimeInterface::ATOM;

    public static function dateToString(\DateTimeInterface $date, ?string $timezone = null): string
    {
        /** @phpstan-ignore-next-line */
        if (false === $date instanceof \DateTime && false === $date instanceof \DateTimeImmutable) {
            throw new InvalidDateInstanceException();
        }

        $timezone = $timezone ?? self::DEFAULT_TIME_ZONE;
        $dateTime = $date->setTimezone(new \DateTimeZone($timezone));

        return $dateTime->format(\DateTimeInterface::ATOM);
    }

    public static function stringToDateTime(string $date, ?string $format = null, ?string $timezone = null): \DateTime
    {
        $format ??= self::DEFAULT_FORMAT;
        $dateTime = \DateTime::createFromFormat($format, $date);

        if (false === $dateTime) {
            throw new InvalidDateException($date, $format);
        }

        return $dateTime->setTimezone(new \DateTimeZone($timezone ?? self::DEFAULT_TIME_ZONE));
    }

    public static function stringToImmutable(
        string $date,
        ?string $format = null,
        ?string $timezone = null
    ): \DateTimeImmutable {
        return self::immutableFromDateTime(self::stringToDateTime($date, $format, $timezone));
    }

    public static function immutableFromDateTime(\DateTime $mutable): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromMutable($mutable);
    }

    public static function dateTimeFromImmutable(\DateTimeImmutable $immutable): \DateTime
    {
        return self::stringToDateTime(self::dateToString($immutable));
    }
}