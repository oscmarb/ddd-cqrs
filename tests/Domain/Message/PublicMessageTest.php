<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Message;

use Oscmarb\Ddd\Domain\Message\PublicMessage;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Tests\Domain\DomainEvent\DomainEventMock;
use Oscmarb\Ddd\Tests\Test;

final class PublicMessageTest extends Test
{
    public function test_should_return_expected_data(): void
    {
        $messageId = Uuid::rawUuid();
        $messageOccurredOn = Clock::formattedNow();
        $meta = ['first' => 1];

        $domainEvent = new DomainEventMock($messageId, $messageOccurredOn);
        $publicMessage = PublicMessage::fromMessage($domainEvent, $meta);
        $rawPublicMessage = [
            'id' => $messageId,
            'occurred_on' => $messageOccurredOn,
            'type' => 'domain_event',
            'name' => DomainEventMock::eventName(),
            'payload' => $domainEvent->toPrimitives(),
            'meta' => $meta,
        ];


        self::assertEquals($messageId, $publicMessage->id());
        self::assertEquals($messageOccurredOn, $publicMessage->occurredOn());
        self::assertEquals($meta, $publicMessage->meta());
        self::assertEquals($domainEvent->toPrimitives(), $publicMessage->payload());
        self::assertEquals('domain_event', $publicMessage->type());
        self::assertEquals(DomainEventMock::eventName(), $publicMessage->name());
        self::assertEquals($rawPublicMessage, $publicMessage->toPrimitives());
        self::assertEquals(\json_encode($rawPublicMessage, JSON_THROW_ON_ERROR), $publicMessage->toJson());
        self::assertEquals(PublicMessage::fromPrimitives($rawPublicMessage), $publicMessage);
    }
}