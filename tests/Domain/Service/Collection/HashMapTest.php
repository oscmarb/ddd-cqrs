<?php

declare(strict_types=1);

namespace Oscmarb\Ddd\Tests\Domain\Service\Collection;

use Oscmarb\Ddd\Domain\Service\Collection\HashMap;
use Oscmarb\Ddd\Tests\Test;

final class HashMapTest extends Test
{
    public function test_should_return_expected_data(): void
    {
        $array = ['first' => 1, 'second' => 2];
        $map = HashMap::fromArray($array);

        self::assertEquals($array, $map->toArray());
        self::assertEquals(1, $map->get('first'));
        self::assertEquals(\array_keys($array), $map->keys());
        self::assertEquals(\array_values($array), $map->values());
        self::assertEquals(count($array), $map->size());
    }

    public function test_should_put_hash_map_element(): void
    {
        $map = HashMap::empty();
        $map->put('first', 1);

        self::assertEquals(['first' => 1], $map->toArray());
    }

    public function test_should_remove_hash_map_element(): void
    {
        $map = HashMap::fromArray(['first' => 1, 'second' => 2]);
        $map->remove('second');

        self::assertEquals(['first' => 1], $map->toArray());
    }

    public function test_should_remove_all_hash_map_elements(): void
    {
        $map = HashMap::fromArray(['first' => 1, 'second' => 2, 'third' => 3]);
        $map->removeAll(['first', 'third']);

        self::assertEquals(['second' => 2], $map->toArray());
    }
}