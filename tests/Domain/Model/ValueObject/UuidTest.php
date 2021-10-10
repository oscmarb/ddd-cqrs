<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\Exception\InvalidUuidException;
use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Tests\Test;

final class UuidTest extends Test
{
    public function test_should_return_expected_uuid_data(): void
    {
        $rawUuid = 'bc6605f6-ef40-4319-be30-b97b519eff9d';
        $uuid = new Uuid($rawUuid);

        self::assertEquals($rawUuid, $uuid->value());
        self::assertEquals($rawUuid, $uuid->toPrimitives());
        self::assertEquals(\json_encode($rawUuid, JSON_THROW_ON_ERROR), $uuid->toJson());
        self::assertEquals($uuid, $uuid->clone());
        self::assertNotEquals(Uuid::uuid(), $uuid);
    }

    public function test_try_create_an_invalid_uuid(): void
    {
        $this->expectException(InvalidUuidException::class);

        new Uuid('invalid uuid');
    }
}