<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query\Response;

use Oscmarb\Ddd\Domain\Query\Response\FloatResponse;
use Oscmarb\Ddd\Tests\Test;

final class FloatResponseTest extends Test
{
    public function test_should_return_float_response_expected_data(): void
    {
        $float = (float)random_int(0, 100);
        $response = new FloatResponse($float);

        self::assertEquals($float, $response->value());
        self::assertEquals($float, $response->toPrimitives());
        self::assertEquals(\json_encode($response->toPrimitives(), JSON_THROW_ON_ERROR), $response->toJson());
        self::assertEquals('float', FloatResponse::responseType());
        self::assertEquals(
            $response,
            FloatResponse::fromPrimitives(
                $response->toPrimitives(),
                $response->messageId(),
                $response->messageOccurredOn()
            )
        );
    }
}