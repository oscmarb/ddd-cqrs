<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\CollectionValueObject;
use Oscmarb\Ddd\Tests\TestedItem;

final class CollectionValueObjectMock extends CollectionValueObject
{
    protected static function itemsClass(): string
    {
        return TestedItem::class;
    }
}