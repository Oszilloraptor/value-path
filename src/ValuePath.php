<?php

declare(strict_types=1);

namespace Rikta\ValuePath;

use Rikta\ValuePath\Segment\ArraySegment;
use Rikta\ValuePath\Segment\MethodSegment;
use Rikta\ValuePath\Segment\PathSegmentInterface;
use Rikta\ValuePath\Segment\PropertySegment;

/**
 * Allows traversing array/objects with simple paths.
 *
 * it supports arrays and methods with constant arguments
 * a getter-function is generated on construction and the object itself invokable
 *
 * @example
 * [0]->getData('phones')['work']->number->toString()
 * or (equivalent, just more convenient syntax for arrays):
 * .0->getData('phones').work->number->toString()
 */
final class ValuePath implements ValuePathInterface
{
    /** @var PathSegmentInterface[] */
    private array $segments;

    public function __construct(public readonly string $path)
    {
        $this->segments = $this->parseString($this->path);
    }

    /**
     * The ValuePathPath is a callable with constructor, therefore you can just call any instance,
     * e.g. $value =$pathGetter('.something').
     *
     * @param mixed $item
     */
    public function __invoke($item)
    {
        foreach ($this->segments as $segment) {
            $item = $segment->isAccessible($item)
                ? $segment->getFromValue($item)
                : throw new InaccessiblePathSegmentException($segment, $item, $this->path)
            ;
        }

        return $item;
    }

    /** parses a segment into an array with [$type, $name, $args]. */
    private function createSegment(string $segment): PathSegmentInterface
    {
        if (str_ends_with($segment, ']') || str_starts_with($segment, '.')) {
            return new ArraySegment($segment);
        }

        if (str_ends_with($segment, ')')) {
            return new MethodSegment($segment);
        }

        return new PropertySegment($segment);
    }

    /** parses a string into an array of segments. */
    private function parseString(string $path): array
    {
        $matches = [];
        preg_match_all('/(?:\[|->|\.)[^]\-)]+[])]?/m', $path, $matches);

        return array_map([$this, 'createSegment'], $matches[0]);
    }
}
