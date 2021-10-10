<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query\Response;

class QueryResponseRegistry
{
    /** @var array<string, class-string> */
    private array $queryResponseMappings = [];

    /** @param class-string[] $queryResponseClasses */
    public function __construct(array $queryResponseClasses = [])
    {
        $this->addQueryResponses($queryResponseClasses);
    }

    public function queryResponses(): array
    {
        return \array_values($this->queryResponseMappings);
    }

    public function queryResponseClassByName(string $name): string
    {
        if (false === isset($this->queryResponseMappings[$name])) {
            throw new \RuntimeException("The Query Response Class for <$name> name doesn't exists");
        }

        return $this->queryResponseMappings[$name];
    }

    public function queryResponseNameByClass(string $class): string
    {
        $mappings = \array_flip($this->queryResponseMappings);

        if (false === isset($mappings[$class])) {
            throw new \RuntimeException("The Query Response Name for <$class> class doesn't exists");
        }

        return $mappings[$class];
    }

    /** @param class-string $queryResponseClass */
    public function addQueryResponse(string $queryResponseClass): void
    {
        $this->addQueryResponses([$queryResponseClass]);
    }

    /** @param class-string[] $queryResponseClasses */
    public function addQueryResponses(array $queryResponseClasses): void
    {
        $this->queryResponseMappings = \array_merge(
            $this->queryResponseMappings,
            $this->mapQueryResponsesClasses($queryResponseClasses)
        );
    }

    /**
     * @param class-string[] $queryResponseClasses
     * @return array<string, class-string>
     */
    private function mapQueryResponsesClasses(array $queryResponseClasses): array
    {
        $mappings = [];

        foreach ($queryResponseClasses as $queryResponseClass) {
            /** @var string $queryName */
            $queryName = $queryResponseClass::responseType();
            $mappings[$queryName] = $queryResponseClass;
        }

        return $mappings;
    }
}