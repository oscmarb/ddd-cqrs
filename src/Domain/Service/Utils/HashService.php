<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Domain\Service\Utils;

use Oscmarb\Ddd\Domain\Serializable;
use Oscmarb\Ddd\Domain\Service\Date\DateUtils;

final class HashService
{
    public function calculateHash(mixed $data): string
    {
        if (true === \is_string($data) || true === \is_numeric($data)) {
            return sha1(self::objectPrefix(\gettype($data)).$data);
        }

        if (true === $data instanceof \DateTime) {
            return sha1(self::objectPrefix(\gettype($data)).DateUtils::dateToString($data).$data->getTimestamp());
        }

        if (false === $data) {
            return sha1('false');
        }

        if (true === $data) {
            return sha1('true');
        }

        if (null === $data) {
            return sha1('null');
        }

        if (true === \is_array($data)) {
            return sha1(self::objectPrefix(\gettype($data)).json_encode($data, JSON_THROW_ON_ERROR));
        }

        if (true === $data instanceof Serializable) {
            return sha1(self::objectPrefix('serializable').json_encode($data, JSON_THROW_ON_ERROR));
        }

        return spl_object_hash($data);
    }

    public static function newInstance(): self
    {
        return new self();
    }

    private static function objectPrefix(string $objectType): string
    {
        return \sprintf('__/%s/__', $objectType);
    }
}