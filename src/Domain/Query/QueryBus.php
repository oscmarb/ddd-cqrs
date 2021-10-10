<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query;

use Oscmarb\Ddd\Domain\Query\Response\QueryResponse;

interface QueryBus
{
    public function handle(Query $query): QueryResponse;
}