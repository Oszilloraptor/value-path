<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Segment;

/**
 * @internal
 */
final class ArraySegment implements PathSegmentInterface
{
    private $key;
    private string $notation;

    public function __construct(string $notation)
    {
        $this->notation = $notation;
        $this->key = trim($notation, '["\'.]');
    }

    /** {@inheritDoc} */
    public function getFromValue($value)
    {
        return $value[$this->key];
    }

    /** {@inheritDoc} */
    public function getNotation(): string
    {
        return $this->notation;
    }

    /** {@inheritDoc} */
    public function isAccessible($value): bool
    {
        return isset($value[$this->key]);
    }
}
