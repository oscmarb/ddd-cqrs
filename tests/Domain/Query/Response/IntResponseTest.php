<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query\Response;

use Oscmarb\Ddd\Domain\Query\Response\IntResponse;
use Oscmarb\Ddd\Tests\Test;

final class IntResponseTest extends Test
{
    public function test_should_return_int_response_expected_data(): void
    {
        $int = random_int(0, 100);
        $response = new IntResponse($int);

        self::assertEquals($int, $response->value());
        self::assertEquals($int, $response->toPrimitives());
        self::assertEquals(\json_encode($response->toPrimitives(), JSON_THROW_ON_ERROR), $response->toJson());
        self::assertEquals('int', IntResponse::responseType());
        self::assertEquals(
            $response,
            IntResponse::fromPrimitives(
                $response->toPrimitives(),
                $response->messageId(),
                $response->messageOccurredOn()
            )
        );
    }
}