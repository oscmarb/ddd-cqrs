<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Query\Response;

class StringResponse extends QueryResponse
{
    final public function __construct(
        private string $value,
        ?string $responseId = null,
        ?string $responseOccurredOn = null
    ) {
        parent::__construct($responseId, $responseOccurredOn);
    }

    public static function responseType(): string
    {
        return 'string';
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): self
    {
        return new self($body, $messageId, $messageOccurredOn);
    }

    public function toPrimitives(): string
    {
        return $this->value;
    }
}