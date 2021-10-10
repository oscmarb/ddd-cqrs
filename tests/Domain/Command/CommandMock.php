<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Command;

use Oscmarb\Ddd\Domain\Command\Command;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Service\Date\Clock;

final class CommandMock extends Command
{
    public static function create(?string $messageId = null, ?string $messageOccurredOn = null): self
    {
        return new self(
            $messageId ?? Uuid::rawUuid(),
            $messageOccurredOn ?? Clock::formattedNow()
        );
    }

    public static function commandName(): string
    {
        return 'command_mock';
    }

    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): self
    {
        return new self($messageId, $messageOccurredOn);
    }

    public function toPrimitives(): array
    {
        return [];
    }
}