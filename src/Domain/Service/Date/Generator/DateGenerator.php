<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date\Generator;

interface DateGenerator
{
    public static function now(?string $timezone = null): \DateTimeImmutable;

    public static function nowSub(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable;

    public static function nowAdd(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable;

    public static function yesterday(?string $timezone = null): \DateTimeImmutable;

    public static function tomorrow(?string $timezone = null): \DateTimeImmutable;
}