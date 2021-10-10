<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query\Response;

use Oscmarb\Ddd\Domain\Query\Response\BoolResponse;
use Oscmarb\Ddd\Tests\Test;

final class BoolResponseTest extends Test
{
    public function test_should_return_bool_response_expected_data(): void
    {
        $bool = random_int(0, 1) ? true : false;
        $response = new BoolResponse($bool);

        self::assertEquals($bool, $response->value());
        self::assertEquals($bool, $response->toPrimitives());
        self::assertEquals(\json_encode($response->toPrimitives(), JSON_THROW_ON_ERROR), $response->toJson());
        self::assertEquals('bool', BoolResponse::responseType());
        self::assertEquals(
            $response,
            BoolResponse::fromPrimitives($response->toPrimitives(), $response->messageId(), $response->messageOccurredOn())
        );
    }
}