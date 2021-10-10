<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Command;

interface CommandBus
{
    public function handle(Command $command): void;

    public function handleMultiple(Command ...$commands): void;
}