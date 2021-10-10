<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Command\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class CommandClassNotExistsException extends DomainException
{
    public function __construct(private string $commandClass)
    {
        parent::__construct();
    }

    public function commandClass(): string
    {
        return $this->commandClass;
    }

    public function errorMessage(): string
    {
        return \sprintf('<%s> command class not exists', $this->commandClass);
    }
}