<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\DomainEvent;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEventSubscriberRegistry;
use Oscmarb\Ddd\Tests\Test;

final class DomainEventSubscriberRegistryTest extends Test
{
    public function test_should_return_expected_domain_events_subscribers(): void
    {
        $domainEvent = new DomainEventMock();

        $syncSubscriber = new SyncDomainEventHandlerMock();
        $asyncSubscriber = new AsyncDomainEventHandlerMock();
        $registry = new DomainEventSubscriberRegistry(new \ArrayObject([$syncSubscriber, $asyncSubscriber]));

        self::assertEquals([$syncSubscriber], $registry->getSyncSubscribersByDomainEvent($domainEvent));
        self::assertEquals([$syncSubscriber], $registry->getSyncSubscribers());
        self::assertEquals([$asyncSubscriber], $registry->getAsyncSubscribers());
        self::assertEquals([$asyncSubscriber], $registry->getAsyncSubscribersByDomainEvent($domainEvent));
    }

    public function test_should_return_empty_domain_events_subscribers(): void
    {
        $domainEvent = new DomainEventMock();
        $registry = new DomainEventSubscriberRegistry(new \ArrayObject());

        self::assertEmpty($registry->getSyncSubscribers());
        self::assertEmpty($registry->getAsyncSubscribers());
        self::assertEmpty($registry->getSyncSubscribersByDomainEvent($domainEvent));
        self::assertEmpty($registry->getAsyncSubscribersByDomainEvent($domainEvent));
    }
}