<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain;

interface Cloneable
{
    public function clone(): mixed;
}