<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model;

use Oscmarb\Ddd\Domain\DomainEvent\DomainEvent;
use Oscmarb\Ddd\Domain\Model\AggregateRoot;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;

final class AggregateRootMock extends AggregateRoot
{
    public const ID = 'id';
    private Uuid $id;

    public static function create(?Uuid $uuid = null): self
    {
        return new self($uuid ?? Uuid::uuid());
    }

    public function __construct(Uuid $id)
    {
        $this->id = $id;
    }

    public function setDomainEvents(DomainEvent ...$domainEvents): void
    {
        foreach ($domainEvents as $domainEvent) {
            $this->record($domainEvent);
        }
    }

    public static function fromPrimitives($data): self
    {
        return new self(new Uuid($data[self::ID]));
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function toPrimitives(): array
    {
        return [self::ID => $this->id->value()];
    }
}