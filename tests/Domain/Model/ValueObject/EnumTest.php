<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Tests\Test;

final class EnumTest extends Test
{
    public function test_should_try_create_invalid_enum(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        EnumMock::from('invalid');
    }

    public function test_should_create_valid_enum(): void
    {
        $enum = EnumMock::enum();

        self::assertEquals('enum', $enum->value());
        self::assertEquals('enum', $enum->toPrimitives());
        self::assertEquals($enum, $enum->clone());
        self::assertEquals(\json_encode('enum', JSON_THROW_ON_ERROR), $enum->toJson());
    }
}