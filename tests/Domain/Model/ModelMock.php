<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model;

use Oscmarb\Ddd\Domain\Model\Model;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;

final class ModelMock extends Model
{
    public const ID = 'id';
    public const NAME = 'name';

    private string $id;
    private string $name;

    public static function create(?string $id = null, ?string $name = null): self
    {
        return new self($id ?? Uuid::rawUuid(), $name ?? Uuid::rawUuid());
    }

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function update(string $id, string $name, array $ignoreAttributes): bool
    {
        $this->takeSnapshot();

        $this->id = $id;
        $this->name = $name;

        return $this->haveBeenUpdated($ignoreAttributes);
    }

    public static function fromPrimitives($data): self
    {
        return new self($data[self::ID], $data[self::NAME]);
    }

    public function toPrimitives(): array
    {
        return [self::ID => $this->id, self::NAME => $this->name];
    }
}