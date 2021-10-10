<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Service\Message;

use Oscmarb\Ddd\Domain\Command\CommandRegistry;
use Oscmarb\Ddd\Domain\DomainEvent\DomainEventRegistry;
use Oscmarb\Ddd\Domain\Message\Message;
use Oscmarb\Ddd\Domain\Query\QueryRegistry;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponseRegistry;
use Oscmarb\Ddd\Domain\Service\Message\MessageSerializer;
use Oscmarb\Ddd\Tests\Domain\Command\CommandMock;
use Oscmarb\Ddd\Tests\Domain\DomainEvent\DomainEventMock;
use Oscmarb\Ddd\Tests\Domain\Query\QueryMock;
use Oscmarb\Ddd\Tests\Domain\Query\Response\QueryResponseMock;
use Oscmarb\Ddd\Tests\Test;

final class MessageSerializerTest extends Test
{
    private MessageSerializer $serializer;

    protected function setUp(): void
    {
        $domainEventRegistry = new DomainEventRegistry([DomainEventMock::class]);
        $commandRegistry = new CommandRegistry([CommandMock::class]);
        $queryRegistry = new QueryRegistry([QueryMock::class]);
        $queryResponseRegistry = new QueryResponseRegistry([QueryResponseMock::class]);
        $this->serializer = new MessageSerializer(
            $commandRegistry,
            $queryRegistry,
            $domainEventRegistry,
            $queryResponseRegistry
        );
    }

    public function test_should_serialize_domain_event(): void
    {
        $domainEvent = new DomainEventMock();

        self::assertEquals($domainEvent, $this->deserializeMessage($domainEvent));
    }

    public function test_should_serialize_command(): void
    {
        $command = CommandMock::create();

        self::assertEquals($command, $this->deserializeMessage($command));
    }

    public function test_should_serialize_query(): void
    {
        $query = QueryMock::create();

        self::assertEquals($query, $this->deserializeMessage($query));
    }

    public function test_should_serialize_query_response(): void
    {
        $queryResponse = QueryResponseMock::create();

        self::assertEquals($queryResponse, $this->deserializeMessage($queryResponse));
    }

    private function deserializeMessage(Message $message): Message
    {
        return $this->serializer->deserialize(
            $message->messageId(),
            $message->messageOccurredOn(),
            $message->toPrimitives(),
            $message->messageName(),
            $message->messageType()
        );
    }
}