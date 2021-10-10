<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Message;

use Oscmarb\Ddd\Domain\Cloneable;
use Oscmarb\Ddd\Domain\Comparable;
use Oscmarb\Ddd\Domain\Message\Exception\InvalidMessageTypeException;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Serializable;
use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Domain\Service\Date\DateUtils;

abstract class Message implements Comparable, Cloneable, Serializable
{
    public const COMMAND_TYPE = 'command';
    public const QUERY_TYPE = 'query';
    public const QUERY_RESPONSE_TYPE = 'response';
    public const DOMAIN_EVENT_TYPE = 'domain_event';

    private string $messageType;
    private string $messageId;
    private string $messageOccurredOn;

    public function __construct(string $messageType, ?string $messageId = null, ?string $messageOccurredOn = null)
    {
        $this->messageType = $messageType;
        $this->messageId = $messageId ?? Uuid::rawUuid();
        $this->messageOccurredOn = $messageOccurredOn ?? Clock::formattedNow();

        $this->assert();
    }

    /**
     * @param mixed $body
     * @param string $messageId
     * @param string $messageOccurredOn
     * @return static
     */
    abstract public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn);

    abstract public function messageName(): string;

    public static function version(): int
    {
        return 1;
    }

    public function clone(): static
    {
        return static::fromPrimitives($this->toPrimitives(), $this->messageId, $this->messageOccurredOn);
    }

    public function equals(mixed $item): bool
    {
        return true === $item instanceof $this
            && $this->toJson() === $item->toJson()
            && $this->messageId === $item->messageId
            && $this->messageOccurredOn === $item->messageOccurredOn;
    }

    public function toJson(): string
    {
        return \json_encode($this->toPrimitives(), JSON_THROW_ON_ERROR);
    }

    public function occurredOnDateTimeImmutable(): \DateTimeImmutable
    {
        return DateUtils::stringToImmutable($this->messageOccurredOn());
    }

    public function messageId(): string
    {
        return $this->messageId;
    }

    public function messageOccurredOn(): string
    {
        return $this->messageOccurredOn;
    }

    public function messageType(): string
    {
        return $this->messageType;
    }

    public function priority(): int
    {
        return 0;
    }

    public function isCommand(): bool
    {
        return self::isCommandType($this->messageType);
    }

    public function isDomainEvent(): bool
    {
        return self::isDomainEventType($this->messageType);
    }

    public function isQuery(): bool
    {
        return self::isQueryType($this->messageType);
    }

    public function isQueryResponse(): bool
    {
        return self::isQueryResponseType($this->messageType);
    }

    public static function isDomainEventType(string $type): bool
    {
        return self::DOMAIN_EVENT_TYPE === $type;
    }

    public static function isCommandType(string $type): bool
    {
        return self::COMMAND_TYPE === $type;
    }

    public static function isQueryType(string $type): bool
    {
        return self::QUERY_TYPE === $type;
    }

    public static function isQueryResponseType(string $type): bool
    {
        return self::QUERY_RESPONSE_TYPE === $type;
    }

    private function assert(): void
    {
        if (false === self::isValidType($this->messageType)) {
            throw new InvalidMessageTypeException($this->messageType);
        }
    }

    public static function isValidType(string $type): bool
    {
        return true === \in_array($type, self::allTypes());
    }

    public static function allTypes(): array
    {
        return [
            self::COMMAND_TYPE,
            self::QUERY_TYPE,
            self::QUERY_RESPONSE_TYPE,
            self::DOMAIN_EVENT_TYPE,
        ];
    }
}