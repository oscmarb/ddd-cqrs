<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query;

use Oscmarb\Ddd\Domain\Query\Exception\QueryClassNotExistsException;
use Oscmarb\Ddd\Domain\Query\Exception\QueryNameNotExistsException;

final class QueryRegistry
{
    /** @var class-string[] */
    private array $queriesMappings = [];

    /** @param class-string[] $queriesClasses */
    public function __construct(array $queriesClasses = [])
    {
        $this->addQueries($queriesClasses);
    }

    public function queries(): array
    {
        return \array_values($this->queriesMappings);
    }

    public function queryClassByName(string $name): string
    {
        return $this->queriesMappings[$name] ?? throw new QueryNameNotExistsException($name);
    }

    public function queryNameByClass(string $class): string
    {
        return \array_flip($this->queriesMappings)[$class] ?? throw new QueryClassNotExistsException($class);
    }

    /** @param class-string $queryClass */
    public function addQuery(string $queryClass): void
    {
        $this->addQueries([$queryClass]);
    }

    /** @param class-string[] $queriesClasses */
    public function addQueries(array $queriesClasses): void
    {
        $this->queriesMappings = \array_merge($this->queriesMappings, $this->mapQueriesClasses($queriesClasses));
    }

    /**
     * @param class-string[] $queriesClasses
     * @return array<string, class-string>
     */
    private function mapQueriesClasses(array $queriesClasses): array
    {
        $mappings = [];

        foreach ($queriesClasses as $queryClass) {
            /** @var string $queryName */
            $queryName = $queryClass::queryName();
            $mappings[$queryName] = $queryClass;
        }

        return $mappings;
    }
}