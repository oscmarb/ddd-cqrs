<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Model;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;

abstract class Entity extends Model
{
    abstract public function id(): Uuid;
}