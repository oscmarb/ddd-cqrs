<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain;

interface Serializable
{
    /**
     * @return mixed
     */
    public function toPrimitives();
}