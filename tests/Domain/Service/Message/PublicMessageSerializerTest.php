<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Service\Message;

use Oscmarb\Ddd\Domain\Command\CommandRegistry;
use Oscmarb\Ddd\Domain\DomainEvent\DomainEventRegistry;
use Oscmarb\Ddd\Domain\Message\PublicMessage;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Query\QueryRegistry;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponseRegistry;
use Oscmarb\Ddd\Domain\Service\Message\MessageSerializer;
use Oscmarb\Ddd\Domain\Service\Message\PublicMessageSerializer;
use Oscmarb\Ddd\Tests\Domain\Command\CommandMock;
use Oscmarb\Ddd\Tests\Domain\DomainEvent\DomainEventMock;
use Oscmarb\Ddd\Tests\Domain\Query\QueryMock;
use Oscmarb\Ddd\Tests\Domain\Query\Response\QueryResponseMock;
use Oscmarb\Ddd\Tests\Test;

final class PublicMessageSerializerTest extends Test
{
    private PublicMessageSerializer $publicMessageSerializer;

    protected function setUp(): void
    {
        $messageSerializer = new MessageSerializer(
            new CommandRegistry([CommandMock::class]),
            new QueryRegistry([QueryMock::class]),
            new DomainEventRegistry([DomainEventMock::class]),
            new QueryResponseRegistry([QueryResponseMock::class])
        );

        $this->publicMessageSerializer = new PublicMessageSerializer($messageSerializer);
    }

    public function test_should_decode_command_json_public_message(): void
    {
        $command = CommandMock::create();
        $decodedCommand = $this->publicMessageSerializer->deserializeJsonToMessage(
            PublicMessage::fromMessage($command)->toJson()
        );

        self::assertEquals($command, $decodedCommand);
    }

    public function test_should_decode_query_json_public_message(): void
    {
        $query = QueryMock::create();
        $decodedQuery = $this->publicMessageSerializer->deserializeJsonToMessage(
            PublicMessage::fromMessage($query)->toJson()
        );

        self::assertEquals($query, $decodedQuery);
    }

    public function test_should_decode_domain_event_json_public_message(): void
    {
        $domainEvent = new DomainEventMock();
        $decodedDomainEvent = $this->publicMessageSerializer->deserializeJsonToMessage(
            PublicMessage::fromMessage($domainEvent)->toJson()
        );

        self::assertEquals($domainEvent, $decodedDomainEvent);
    }

    public function test_should_decode_query_response_json_public_message(): void
    {
        $queryResponse = new QueryResponseMock(Uuid::rawUuid());
        $decodedQueryResponse = $this->publicMessageSerializer->deserializeJsonToMessage(
            PublicMessage::fromMessage($queryResponse)->toJson()
        );

        self::assertEquals($queryResponse, $decodedQueryResponse);
    }
}