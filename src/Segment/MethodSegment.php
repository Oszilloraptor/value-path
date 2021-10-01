<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Segment;

/**
 * @internal
 */
final class MethodSegment implements PathSegmentInterface
{
    private readonly array $args;
    private readonly mixed $key;

    public function __construct(public readonly string $notation)
    {
        $key = mb_substr($notation, 2, mb_strpos($notation, '(') - 2);
        if(is_numeric($key) && intval($key) == floatval($key)) {
            $key = intval($key);
        }
        $this->key = $key;

        $argMatches = [];
        preg_match_all('/[\'"](.+)[\'"]/mU', $notation, $argMatches);
        $this->args = $argMatches[1] ?? [];
    }

    /** {@inheritDoc} */
    public function getFromValue($value)
    {
        return $value->{$this->key}(...$this->args);
    }

    /** {@inheritDoc} */
    public function getNotation(): string
    {
        return $this->notation;
    }

    /** {@inheritDoc} */
    public function isAccessible($value): bool
    {
        return \is_callable([$value, $this->key]);
    }
}
