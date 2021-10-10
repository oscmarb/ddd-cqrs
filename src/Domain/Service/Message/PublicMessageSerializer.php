<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Message;

use Oscmarb\Ddd\Domain\Message\Message;
use Oscmarb\Ddd\Domain\Message\PublicMessage;

final class PublicMessageSerializer
{
    private MessageSerializer $messageSerializer;

    public function __construct(MessageSerializer $messageSerializer)
    {
        $this->messageSerializer = $messageSerializer;
    }

    public function deserializeJsonToMessage(string $json): Message
    {
        return $this->mapToMessage(PublicMessage::fromJson($json));
    }

    public function deserializeToMessage(array $data): Message
    {
        return $this->mapToMessage(PublicMessage::fromPrimitives($data));
    }

    public function mapToMessage(PublicMessage $publicMessage): Message
    {
        return $this->messageSerializer->deserialize(
            $publicMessage->id(),
            $publicMessage->occurredOn(),
            $publicMessage->payload(),
            $publicMessage->name(),
            $publicMessage->type(),
        );
    }
}