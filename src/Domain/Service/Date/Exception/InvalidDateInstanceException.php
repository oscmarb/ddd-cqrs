<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class InvalidDateInstanceException extends DomainException
{
    public function errorMessage(): string
    {
        return 'Invalid date';
    }
}