<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Query\Query;
use Oscmarb\Ddd\Domain\Service\Date\Clock;

final class QueryMock extends Query
{
    public static function create(?string $queryId = null, ?string $occurredOn = null): self
    {
        return new self($queryId ?? Uuid::rawUuid(), $occurredOn ?? Clock::formattedNow());
    }

    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): self
    {
        return new self($messageId, $messageOccurredOn);
    }

    public function toPrimitives(): array
    {
        return [];
    }

    public static function queryName(): string
    {
        return 'query_message';
    }
}