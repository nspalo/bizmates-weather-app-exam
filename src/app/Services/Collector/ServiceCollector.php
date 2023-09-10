<?php

declare(strict_types=1);

namespace App\Services\Collector;

class ServiceCollector
{
    /**
     * @param iterable $objects
     * @param string $class
     * @return array
     */
    public static function filterByClass(iterable $objects, string $class): array
    {
        $objects = $objects instanceof \Traversable ? \iterator_to_array($objects) : (array) $objects;

        return \array_filter($objects, static function ($object) use ($class): bool {
            return $object instanceof $class;
        });
    }
}
