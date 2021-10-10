<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class QueryNameNotExistsException extends DomainException
{
    public function __construct(private string $queryName)
    {
        parent::__construct();
    }

    public function queryName(): string
    {
        return $this->queryName;
    }

    public function errorMessage(): string
    {
        return \sprintf('<%s> query name not exists', $this->queryName);
    }
}