<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Segment;

/**
 * @internal
 */
interface PathSegmentInterface
{
    /** Returns the value from the key (which must've been set previously, e.g. via the constructor) */
    public function getFromValue($value);

    /** Returns the string-notation of the path-segment, e.g. for exceptions. */
    public function getNotation(): string;

    /** Checks if the segment is accessible on the given value */
    public function isAccessible($value): bool;
}
