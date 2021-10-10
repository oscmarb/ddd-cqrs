<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Command;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Service\Date\Clock;
use Oscmarb\Ddd\Tests\Test;

final class CommandTest extends Test
{
    public function test_should_return_expected_data(): void
    {
        $commandId = Uuid::rawUuid();
        $occurredOn = Clock::formattedNow();

        $command = new CommandMock($commandId, $occurredOn);

        self::assertTrue($command->equals($command));
        self::assertEquals($command, $command->clone());
        self::assertEquals($occurredOn, $command->messageOccurredOn());
        self::assertEquals($commandId, $command->messageId());
        self::assertEquals('command', $command->messageType());
        self::assertTrue($command->isCommand());
        self::assertEquals(CommandMock::commandName(), $command->messageName());
    }
}