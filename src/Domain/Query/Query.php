<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query;

use Oscmarb\Ddd\Domain\Message\Message;

abstract class Query extends Message
{
    public function __construct(?string $queryId = null, ?string $queryOccurredOn = null)
    {
        parent::__construct(Message::QUERY_TYPE, $queryId, $queryOccurredOn);
    }

    public function messageName(): string
    {
        return static::queryName();
    }

    abstract public static function queryName(): string;
}