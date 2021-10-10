<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query;

use Oscmarb\Ddd\Domain\Query\Exception\QueryClassNotExistsException;
use Oscmarb\Ddd\Domain\Query\QueryRegistry;
use Oscmarb\Ddd\Tests\Test;

final class QueryRegistryTest extends Test
{
    public function test_should_return_expected_query(): void
    {
        $registry = new QueryRegistry([QueryMock::class]);

        self::assertEquals(QueryMock::class, $registry->queryClassByName(QueryMock::queryName()));
        self::assertEquals(QueryMock::queryName(), $registry->queryNameByClass(QueryMock::class));
    }

    public function test_should_add_query(): void
    {
        $registry = new QueryRegistry();
        $registry->addQuery(QueryMock::class);

        self::assertNotNull($registry->queryNameByClass(QueryMock::class));
    }

    public function test_should_add_queries(): void
    {
        $registry = new QueryRegistry();
        $registry->addQueries([QueryMock::class]);

        self::assertNotNull($registry->queryNameByClass(QueryMock::class));
    }

    public function test_try_get_not_registered_query(): void
    {
        $this->expectException(QueryClassNotExistsException::class);

        $registry = new QueryRegistry();
        $registry->queryNameByClass(QueryMock::class);
    }
}