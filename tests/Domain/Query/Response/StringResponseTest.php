<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query\Response;

use Oscmarb\Ddd\Domain\Query\Response\StringResponse;
use Oscmarb\Ddd\Tests\Test;

final class StringResponseTest extends Test
{
    public function test_should_return_string_response_expected_data(): void
    {
        $string = 'aString';
        $response = new StringResponse($string);

        self::assertEquals($string, $response->value());
        self::assertEquals($string, $response->toPrimitives());
        self::assertEquals(\json_encode($response->toPrimitives(), JSON_THROW_ON_ERROR), $response->toJson());
        self::assertEquals('string', StringResponse::responseType());
        self::assertEquals(
            $response,
            StringResponse::fromPrimitives(
                $response->toPrimitives(),
                $response->messageId(),
                $response->messageOccurredOn()
            )
        );
    }
}