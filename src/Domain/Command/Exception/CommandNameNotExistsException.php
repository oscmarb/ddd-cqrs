<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Command\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class CommandNameNotExistsException extends DomainException
{
    public function __construct(private string $commandName)
    {
        parent::__construct();
    }

    public function commandName(): string
    {
        return $this->commandName;
    }

    public function errorMessage(): string
    {
        return \sprintf('<%s> command name not exists', $this->commandName);
    }
}