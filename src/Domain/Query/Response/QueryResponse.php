<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query\Response;

use Oscmarb\Ddd\Domain\Message\Message;

abstract class QueryResponse extends Message
{
    public function __construct(?string $responseId = null, ?string $responseOccurredOn = null)
    {
        parent::__construct(Message::QUERY_RESPONSE_TYPE, $responseId, $responseOccurredOn);
    }

    public function messageName(): string
    {
        return static::responseType();
    }

    abstract public static function responseType(): string;
}