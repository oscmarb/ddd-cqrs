<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Command;

use Oscmarb\Ddd\Domain\Command\CommandRegistry;
use Oscmarb\Ddd\Domain\Command\Exception\CommandClassNotExistsException;
use Oscmarb\Ddd\Tests\Test;

final class CommandRegistryTest extends Test
{
    public function test_should_return_expected_command(): void
    {
        $registry = new CommandRegistry([CommandMock::class]);

        self::assertEquals(CommandMock::class, $registry->commandClassByName(CommandMock::commandName()));
        self::assertEquals(CommandMock::commandName(), $registry->commandNameByClass(CommandMock::class));
    }

    public function test_should_add_command(): void
    {
        $registry = new CommandRegistry();
        $registry->addCommand(CommandMock::class);

        self::assertNotNull($registry->commandNameByClass(CommandMock::class));
    }

    public function test_should_add_commands(): void
    {
        $registry = new CommandRegistry();
        $registry->addCommands([CommandMock::class]);

        self::assertNotNull($registry->commandNameByClass(CommandMock::class));
    }

    public function test_try_get_not_registered_command(): void
    {
        $this->expectException(CommandClassNotExistsException::class);

        $registry = new CommandRegistry();
        $registry->commandNameByClass(CommandMock::class);
    }
}