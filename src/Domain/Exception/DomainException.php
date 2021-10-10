<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Exception;

use Oscmarb\Ddd\Domain\Service\Utils\Utils;

abstract class DomainException extends \RuntimeException
{
    abstract public function errorMessage(): string;

    public function errorCode(): string
    {
        return $this->classErrorCode();
    }

    protected function classErrorCode(): string
    {
        $formattedClassName = Utils::toSnakeCase(static::class);

        return \str_ends_with($formattedClassName, '_exception')
            ? \substr($formattedClassName, 0, -10)
            : $formattedClassName;
    }
}