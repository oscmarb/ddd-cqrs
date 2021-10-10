<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\DomainEvent;

use Oscmarb\Ddd\Domain\DomainEvent\Exception\DomainEventClassNotExistsException;
use Oscmarb\Ddd\Domain\DomainEvent\Exception\DomainEventNameNotExistsException;

final class DomainEventRegistry
{
    /** @var class-string[] */
    private array $domainEventsMappings = [];

    /** @param class-string[] $domainEventsClasses */
    public function __construct(array $domainEventsClasses = [])
    {
        $this->addDomainEvents($domainEventsClasses);
    }

    public function domainEvents(): array
    {
        return \array_values($this->domainEventsMappings);
    }

    public function domainEventClassByName(string $name): string
    {
        if (false === isset($this->domainEventsMappings[$name])) {
            throw new DomainEventNameNotExistsException($name);
        }

        return $this->domainEventsMappings[$name];
    }

    public function domainEventNameByClass(string $class): string
    {
        $mappings = \array_flip($this->domainEventsMappings);

        if (false === isset($mappings[$class])) {
            throw new DomainEventClassNotExistsException($class);
        }

        /** @var string $name */
        $name = $mappings[$class];

        return $name;
    }

    /** @param class-string $domainEventClass */
    public function addDomainEvent(string $domainEventClass): void
    {
        $this->addDomainEvents([$domainEventClass]);
    }

    /** @param class-string[] $domainEventsClasses */
    public function addDomainEvents(array $domainEventsClasses): void
    {
        $this->domainEventsMappings = \array_merge(
            $this->domainEventsMappings,
            $this->mapDomainEventsClasses($domainEventsClasses)
        );
    }

    /**
     * @param class-string[] $domainEventsClasses
     * @return array<string, class-string>
     */
    private function mapDomainEventsClasses(array $domainEventsClasses): array
    {
        $mappings = [];

        foreach ($domainEventsClasses as $domainEventClass) {
            /** @var string $eventName */
            $eventName = $domainEventClass::eventName();
            $mappings[$eventName] = $domainEventClass;
        }

        return $mappings;
    }
}