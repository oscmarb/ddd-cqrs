<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query\Response;

class FloatResponse extends QueryResponse
{
    final public function __construct(
        private float $value,
        ?string $responseId = null,
        ?string $responseOccurredOn = null
    ) {
        parent::__construct($responseId, $responseOccurredOn);
    }

    public static function responseType(): string
    {
        return 'float';
    }

    public function value(): float
    {
        return $this->value;
    }

    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): self
    {
        return new self($body, $messageId, $messageOccurredOn);
    }

    public function toPrimitives(): float
    {
        return $this->value;
    }
}