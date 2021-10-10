<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query\Exception;

use Oscmarb\Ddd\Domain\Exception\DomainException;

final class QueryClassNotExistsException extends DomainException
{
    public function __construct(private string $queryClass)
    {
        parent::__construct();
    }

    public function queryClass(): string
    {
        return $this->queryClass;
    }

    public function errorMessage(): string
    {
        return \sprintf('<%s> query class not exists', $this->queryClass);
    }
}