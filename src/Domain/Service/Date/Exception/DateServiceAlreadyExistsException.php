<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Date\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class DateServiceAlreadyExistsException extends DomainException
{
    public function errorMessage(): string
    {
        return 'DateService is already created';
    }
}