<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class InvalidDateException extends DomainException
{
    public function __construct(private string $date, private string $format)
    {
        parent::__construct();
    }

    public function date(): string
    {
        return $this->date;
    }

    public function format(): string
    {
        return $this->format;
    }

    public function errorMessage(): string
    {
        return \sprintf('%s date is not valid for %s format', $this->date, $this->format);
    }
}