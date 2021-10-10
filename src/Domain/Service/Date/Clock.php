<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date;

use Oscmarb\Ddd\Domain\Service\Date\Exception\DateServiceAlreadyExistsException;
use Oscmarb\Ddd\Domain\Service\Date\Generator\DateGenerator;
use Oscmarb\Ddd\Domain\Service\Date\Generator\DateTimeGenerator;

final class Clock
{
    private static ?self $instance = null;

    private function __construct(private DateGenerator $generator)
    {
    }

    public static function instance(): self
    {
        return self::$instance ??= self::createDefault();
    }

    public static function isInstantiated(): bool
    {
        return null !== self::$instance;
    }

    public static function create(DateGenerator $generator): self
    {
        if (true === self::isInstantiated()) {
            throw new DateServiceAlreadyExistsException();
        }

        return self::$instance = new self($generator);
    }

    public static function formattedNow(?string $timezone = null): string
    {
        return DateUtils::dateToString(self::now($timezone));
    }

    public static function now(?string $timezone = null): \DateTimeImmutable
    {
        return self::instance()->generator::now($timezone);
    }

    public function nowTimestamp(?string $timezone = null): int
    {
        return self::now($timezone)->getTimestamp();
    }

    public static function yesterday(?string $timezone = null): \DateTimeImmutable
    {
        return self::instance()->generator::yesterday($timezone);
    }

    public static function tomorrow(?string $timezone = null): \DateTimeImmutable
    {
        return self::instance()->generator::tomorrow($timezone);
    }

    public static function nowSub(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable
    {
        return self::instance()->generator::nowSub($interval, $timezone);
    }

    public static function nowAdd(\DateInterval $interval, ?string $timezone = null): \DateTimeImmutable
    {
        return self::instance()->generator::nowAdd($interval, $timezone);
    }

    public static function clear(): void
    {
        self::$instance = null;
    }

    private static function createDefault(): self
    {
        return new self(new DateTimeGenerator());
    }
}