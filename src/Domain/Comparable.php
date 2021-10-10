<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain;

interface Comparable
{
    public function equals(mixed $item): bool;
}