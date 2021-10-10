<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\DomainEvent;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Tests\Test;

final class DomainEventTest extends Test
{
    public function test_should_return_expected_domain_event_data(): void
    {
        $eventId = Uuid::rawUuid();
        $occurredOn = Clock::formattedNow();

        $domainEvent = new DomainEventMock($eventId, $occurredOn);

        self::assertTrue($domainEvent->equals($domainEvent));
        self::assertEquals($domainEvent, $domainEvent->clone());
        self::assertEquals($occurredOn, $domainEvent->messageOccurredOn());
        self::assertEquals($eventId, $domainEvent->messageId());
        self::assertTrue($domainEvent->isDomainEvent());
        self::assertEquals(DomainEventMock::eventName(), $domainEvent->messageName());
    }
}