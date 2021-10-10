<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Query\Response;

use Oscmarb\Ddd\Domain\Model\ValueObject\Uuid;
use Oscmarb\Ddd\Domain\Query\Response\QueryResponse;
use Oscmarb\Ddd\Tests\TestedItem;

final class QueryResponseMock extends QueryResponse
{
    private string $id;

    public static function create(): self
    {
        return new self(Uuid::rawUuid());
    }

    public static function fromTestedItem(TestedItem $testedItem): self
    {
        return new self($testedItem->id());
    }

    public function __construct(string $id, ?string $responseId = null, ?string $responseOccurredOn = null)
    {
        $this->id = $id;

        parent::__construct($responseId, $responseOccurredOn);
    }

    public static function fromPrimitives(mixed $body, string $messageId, string $messageOccurredOn): self
    {
        return new self($body['id'], $messageId, $messageOccurredOn);
    }

    public static function responseType(): string
    {
        return 'mock';
    }

    public function toPrimitives(): array
    {
        return ['id' => $this->id];
    }
}