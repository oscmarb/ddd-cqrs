<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Message;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Serializable;

final class PublicMessage implements Serializable
{
    public const ID = 'id';
    public const OCCURRED_ON = 'occurred_on';
    public const TYPE = 'type';
    public const NAME = 'name';
    public const PAYLOAD = 'payload';
    public const META = 'meta';

    public function __construct(
        private string $id,
        private string $occurredOn,
        private string $type,
        private string $name,
        private array $payload,
        private array $meta = []
    ) {
        if (null !== $this->id) {
            Uuid::uuidOrException($id);
        }
    }

    public function id(): string
    {
        return $this->id;
    }

    public function occurredOn(): string
    {
        return $this->occurredOn;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function payload(): array
    {
        return $this->payload;
    }

    public function meta(): array
    {
        return $this->meta;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromPrimitives(mixed $data): self
    {
        return new self(
            $data[self::ID],
            $data[self::OCCURRED_ON],
            $data[self::TYPE],
            $data[self::NAME],
            $data[self::PAYLOAD],
            $data[self::META]
        );
    }

    public function toPrimitives(): array
    {
        return [
            self::ID => $this->id,
            self::OCCURRED_ON => $this->occurredOn,
            self::TYPE => $this->type,
            self::NAME => $this->name,
            self::PAYLOAD => $this->payload,
            self::META => $this->meta,
        ];
    }

    public static function fromJson(string $json): self
    {
        return self::fromPrimitives(\json_decode($json, true, 512, JSON_THROW_ON_ERROR));
    }

    public function toJson(): string
    {
        return \json_encode($this->toPrimitives(), JSON_THROW_ON_ERROR);
    }

    public static function fromMessage(Message $message, array $meta = []): self
    {
        return new self(
            $message->messageId(),
            $message->messageOccurredOn(),
            $message->messageType(),
            $message->messageName(),
            $message->toPrimitives(),
            $meta
        );
    }
}