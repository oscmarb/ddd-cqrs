<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Service\Collection\Collection;
use Oscmarb\Ddd\Tests\Test;
use Oscmarb\Ddd\Tests\TestedItem;

final class CollectionValueObjectTest extends Test
{
    public function test_should_return_collection_value_object_data(): void
    {
        $array = [new TestedItem('first'), new TestedItem('second')];
        $primitivesArray = \array_map(static fn(TestedItem $item) => $item->toPrimitives(), $array);
        $collectionValueObject = new CollectionValueObjectMock($array);

        self::assertEquals($array, $collectionValueObject->toArray());
        self::assertEquals($primitivesArray, $collectionValueObject->toPrimitives());
        self::assertEquals(\json_encode($primitivesArray, JSON_THROW_ON_ERROR), $collectionValueObject->toJson());
        self::assertEquals($collectionValueObject, $collectionValueObject->clone());
        self::assertEquals(Collection::from($array), $collectionValueObject->toCollection());
        self::assertTrue($collectionValueObject->equals($collectionValueObject));
        self::assertFalse($collectionValueObject->equals(CollectionValueObjectMock::empty()));
    }

    public function test_try_create_collection_with_invalid_item(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        CollectionValueObjectMock::from([CollectionValueObjectMock::empty()]);
    }
}