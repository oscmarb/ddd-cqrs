<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain;

interface Deserializable
{
    /**
     * @param mixed $data
     * @return mixed
     */
    public static function fromPrimitives(mixed $data);
}