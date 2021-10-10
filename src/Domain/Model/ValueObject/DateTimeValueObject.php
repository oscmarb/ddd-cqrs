<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Domain\Service\Date\DateUtils;

class DateTimeValueObject extends ValueObject
{
    public static function now(): static
    {
        return new static(Clock::formattedNow());
    }

    final public function __construct(protected string $value, ?string $timezone = null)
    {
        $date = DateUtils::stringToImmutable($this->value, null, $timezone);
        $this->value = DateUtils::dateToString($date);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function toDateTimeImmutable(): \DateTimeImmutable
    {
        return DateUtils::stringToImmutable($this->value);
    }

    public function greaterThan(self $dateTimeValueObject): bool
    {
        return $this->toDateTimeImmutable() > $dateTimeValueObject->toDateTimeImmutable();
    }

    public function lessThan(self $dateTimeValueObject): bool
    {
        return false === $this->greaterThan($dateTimeValueObject);
    }

    public function toPrimitives(): string
    {
        return $this->value;
    }

    public static function fromPrimitives($data): static
    {
        return new static($data);
    }
}