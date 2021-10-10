<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query\Response;

use Oscmarb\Ddd\Domain\Query\Response\ArrayResponse;
use Oscmarb\Ddd\Tests\Test;

final class ArrayResponseTest extends Test
{
    public function test_should_return_expected_array_response_data(): void
    {
        $array = ['first' => 1, 'second' => 2];
        $response = new ArrayResponse($array);

        self::assertEquals($array, $response->value());
        self::assertEquals($array, $response->toPrimitives());
        self::assertEquals(\json_encode($response->toPrimitives(), JSON_THROW_ON_ERROR), $response->toJson());
        self::assertEquals('array', ArrayResponse::responseType());
        self::assertEquals($response, ArrayResponse::fromPrimitives($response->toPrimitives(),
            $response->messageId(),
            $response->messageOccurredOn()));
    }
}