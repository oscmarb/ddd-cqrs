<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class InvalidDateIntervalUnitException extends DomainException
{
    public function __construct(private string $unit)
    {
        parent::__construct();
    }

    public function unit(): string
    {
        return $this->unit;
    }

    public function errorMessage(): string
    {
        return sprintf('%s is not a valid date interval unit', $this->unit);
    }
}