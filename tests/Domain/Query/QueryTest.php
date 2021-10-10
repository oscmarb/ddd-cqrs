<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Tests\Test;

final class QueryTest extends Test
{
    public function test_should_return_query_expected_data(): void
    {
        $queryId = Uuid::rawUuid();
        $occurredOn = Clock::formattedNow();

        $query = new QueryMock($queryId, $occurredOn);

        self::assertTrue($query->equals($query));
        self::assertEquals($query, $query->clone());
        self::assertEquals($occurredOn, $query->messageOccurredOn());
        self::assertEquals($queryId, $query->messageId());
        self::assertEquals('query', $query->messageType());
        self::assertTrue($query->isQuery());
        self::assertEquals(QueryMock::queryName(), $query->messageName());
    }
}