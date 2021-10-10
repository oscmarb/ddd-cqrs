<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Model\ValueObject;

use Oscmarb\Ddd\Domain\Model\ValueObject\Enum;

/**
 * @method static static enum()
 */
final class EnumMock extends Enum
{
    public const ENUM = 'enum';
}