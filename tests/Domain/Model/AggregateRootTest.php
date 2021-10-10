<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model;

use Oscmarb\Ddd\Tests\Domain\DomainEvent\DomainEventMock;
use Oscmarb\Ddd\Tests\Test;

final class AggregateRootTest extends Test
{
    public function test_should_pull_expected_domain_events(): void
    {
        $aggregate = AggregateRootMock::create();

        $events = [new DomainEventMock(), new DomainEventMock()];
        $aggregate->setDomainEvents(...$events);

        self::assertEquals($events, $aggregate->pullDomainEvents());
        self::assertEmpty($aggregate->pullDomainEvents());
    }

    public function test_should_pull_empty_domain_events_array(): void
    {
        self::assertEmpty(AggregateRootMock::create()->pullDomainEvents());
    }
}