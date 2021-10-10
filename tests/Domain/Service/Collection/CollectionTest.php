<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Service\Collection;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Serializable;
use Oscmarb\Ddd\Domain\Service\Collection\Collection;
use Oscmarb\Ddd\Tests\Test;

final class CollectionTest extends Test
{
    public function test_try_create_a_collection_with_invalid_element(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        SerializableTypedCollection::from([Collection::empty()]);
    }

    public function test_should_create_a_collection_with_valid_elements(): void
    {
        $elements = ['first' => new Item(Uuid::rawUuid()), 'second' => new Item(Uuid::rawUuid())];

        $collection = ItemTypedCollection::from($elements);

        self::assertEquals($elements, $collection->toArray());
    }
}

class ItemTypedCollection extends Collection
{
    protected function type(): ?string
    {
        return Item::class;
    }
}

class Item
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}

class SerializableTypedCollection extends Collection
{
    protected function type(): ?string
    {
        return Serializable::class;
    }
}