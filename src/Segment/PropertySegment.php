<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Segment;

/**
 * @internal
 */
final class PropertySegment implements PathSegmentInterface
{
    private readonly string $key;

    public function __construct(public readonly string $notation)
    {
        $this->key = mb_substr($this->notation, 2);
    }

    /** {@inheritDoc} */
    public function getFromValue($value)
    {
        return $value->{$this->key};
    }

    /** {@inheritDoc} */
    public function getNotation(): string
    {
        return $this->notation;
    }

    /** {@inheritDoc} */
    public function isAccessible($value): bool
    {
        return property_exists($value, $this->key);
    }
}
