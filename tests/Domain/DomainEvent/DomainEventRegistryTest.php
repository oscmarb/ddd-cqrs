<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\DomainEvent;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEventRegistry;
use Oscmarb\Ddd\Domain\DomainEvent\Exception\DomainEventClassNotExistsException;
use Oscmarb\Ddd\Tests\Test;

final class DomainEventRegistryTest extends Test
{
    public function test_should_return_expected_domain_event(): void
    {
        $registry = new DomainEventRegistry([DomainEventMock::class]);

        self::assertEquals(DomainEventMock::class, $registry->domainEventClassByName(DomainEventMock::eventName()));
        self::assertEquals(DomainEventMock::eventName(), $registry->domainEventNameByClass(DomainEventMock::class));
    }

    public function test_should_add_domain_event(): void
    {
        $registry = new DomainEventRegistry();
        $registry->addDomainEvent(DomainEventMock::class);

        self::assertNotNull($registry->domainEventNameByClass(DomainEventMock::class));
    }

    public function test_should_add_domain_events(): void
    {
        $registry = new DomainEventRegistry();
        $registry->addDomainEvents([DomainEventMock::class]);

        self::assertNotNull($registry->domainEventNameByClass(DomainEventMock::class));
    }

    public function test_try_get_not_registered_domain_event(): void
    {
        $this->expectException(DomainEventClassNotExistsException::class);

        $registry = new DomainEventRegistry();
        $registry->domainEventNameByClass(DomainEventMock::class);
    }
}