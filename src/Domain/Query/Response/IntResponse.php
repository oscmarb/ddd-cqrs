<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query\Response;

class IntResponse extends QueryResponse
{
    final public function __construct(private int $value, ?string $responseId = null, ?string $responseOccurredOn = null)
    {
        parent::__construct($responseId, $responseOccurredOn);
    }

    public static function responseType(): string
    {
        return 'int';
    }

    public function value(): int
    {
        return $this->value;
    }

    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): self
    {
        return new self($body, $messageId, $messageOccurredOn);
    }

    public function toPrimitives(): int
    {
        return $this->value;
    }
}