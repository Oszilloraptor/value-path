<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Segment;

/**
 * @internal
 */
final class ArraySegment implements PathSegmentInterface
{
    private readonly $key;

    public function __construct(public readonly string $notation)
    {
        $this->key = trim($this->notation, '["\'.]');
    }

    /** {@inheritDoc} */
    public function getFromValue($value)
    {
        return $value[$this->key];
    }

    /** {@inheritDoc} */
    public function isAccessible($value): bool
    {
        return isset($value[$this->key]);
    }
    
    public function getNotation(): string
    {
        return $this->notation;
    }
}
