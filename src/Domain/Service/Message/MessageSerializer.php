<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Message;

use Oscmarb\Ddd\Domain\Command\Command;
use Oscmarb\Ddd\Domain\Command\CommandRegistry;
use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;
use Oscmarb\Ddd\Domain\DomainEvent\DomainEventRegistry;
use Oscmarb\Ddd\Domain\Message\Exception\InvalidMessageTypeException;
use Oscmarb\Ddd\Domain\Message\Message;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Query\Query;
use Oscmarb\Ddd\Domain\Query\QueryRegistry;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponse;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponseRegistry;
use Oscmarb\Ddd\Domain\Service\Date\Clock;

final class MessageSerializer
{
    private CommandRegistry $commandRegistry;
    private QueryRegistry $queryRegistry;
    private DomainEventRegistry $domainEventRegistry;
    private QueryResponseRegistry $queryResponseRegistry;

    public function __construct(
        CommandRegistry $commandRegistry,
        QueryRegistry $queryRegistry,
        DomainEventRegistry $domainEventRegistry,
        QueryResponseRegistry $queryResponseRegistry
    ) {
        $this->commandRegistry = $commandRegistry;
        $this->queryRegistry = $queryRegistry;
        $this->domainEventRegistry = $domainEventRegistry;
        $this->queryResponseRegistry = $queryResponseRegistry;
    }

    public function deserialize(string $id, string $occurredOn, array $payload, string $name, string $type): Message
    {
        if (true === Message::isDomainEventType($type)) {
            $messageClass = $this->domainEventRegistry->domainEventClassByName($name);
        } elseif (true === Message::isCommandType($type)) {
            $messageClass = $this->commandRegistry->commandClassByName($name);
        } elseif (true === Message::isQueryType($type)) {
            $messageClass = $this->queryRegistry->queryClassByName($name);
        } elseif (true === Message::isQueryResponseType($type)) {
            $messageClass = $this->queryResponseRegistry->queryResponseClassByName($name);
        } else {
            throw new InvalidMessageTypeException($type);
        }

        /** @var $messageClass Message */
        return $messageClass::fromPrimitives(
            $payload,
            $id ?? Uuid::rawUuid(),
            $occurredOn ?? Clock::formattedNow()
        );
    }

    public function deserializeDomainEvent(string $id, string $occurredOn, array $payload, string $name): DomainEvent
    {
        /** @var $messageClass DomainEvent */
        $messageClass = $this->domainEventRegistry->domainEventClassByName($name);

        return $messageClass::fromPrimitives($payload, $id, $occurredOn);
    }

    public function deserializeCommand(string $id, string $occurredOn, array $payload, string $name): Command
    {
        /** @var $messageClass Command */
        $messageClass = $this->commandRegistry->commandClassByName($name);

        return $messageClass::fromPrimitives($payload, $id, $occurredOn);
    }

    public function deserializeQuery(string $id, string $occurredOn, array $payload, string $name): Query
    {
        /** @var $messageClass Query */
        $messageClass = $this->queryRegistry->queryClassByName($name);

        return $messageClass::fromPrimitives($payload, $id, $occurredOn);
    }

    public function deserializeQueryResponse(string $id, string $occurredOn, array $payload, string $name): QueryResponse
    {
        /** @var $messageClass QueryResponse */
        $messageClass = $this->queryResponseRegistry->queryResponseClassByName($name);

        return $messageClass::fromPrimitives($payload, $id, $occurredOn);
    }
}