<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Command;

use Oscmarb\Ddd\Domain\Command\Exception\CommandClassNotExistsException;
use Oscmarb\Ddd\Domain\Command\Exception\CommandNameNotExistsException;

final class CommandRegistry
{
    /** @var class-string[] */
    private array $commandsMappings = [];

    /** @param class-string[] $commandsClasses */
    public function __construct(array $commandsClasses = [])
    {
        $this->addCommands($commandsClasses);
    }

    public function commands(): array
    {
        return \array_values($this->commandsMappings);
    }

    public function commandClassByName(string $name): string
    {
        return $this->commandsMappings[$name] ?? throw new CommandNameNotExistsException($name);
    }

    public function commandNameByClass(string $class): string
    {
        return \array_flip($this->commandsMappings)[$class] ?? throw new CommandClassNotExistsException($class);
    }

    /** @param class-string $commandClass */
    public function addCommand(string $commandClass): void
    {
        $this->addCommands([$commandClass]);
    }

    /** @param class-string[] $commandsClasses */
    public function addCommands(array $commandsClasses): void
    {
        $this->commandsMappings = \array_merge($this->commandsMappings, $this->mapCommandsClasses($commandsClasses));
    }

    /**
     * @param class-string[] $commandsClasses
     * @return array<string, class-string>
     */
    private function mapCommandsClasses(array $commandsClasses): array
    {
        $mappings = [];

        foreach ($commandsClasses as $commandClass) {
            /** @var string $commandName */
            $commandName = $commandClass::commandName();
            $mappings[$commandName] = $commandClass;
        }

        return $mappings;
    }
}