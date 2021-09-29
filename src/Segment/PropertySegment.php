<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Segment;

/**
 * @internal
 */
final class PropertySegment implements PathSegmentInterface
{
    private string $key;
    private string $notation;

    public function __construct(string $notation)
    {
        $this->notation = $notation;
        $this->key = mb_substr($notation, 2);
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
