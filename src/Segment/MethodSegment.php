<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Segment;

/**
 * @internal
 */
final class MethodSegment implements PathSegmentInterface
{
    private array $args;
    private $key;
    private string $notation;

    public function __construct(string $notation)
    {
        $this->notation = $notation;
        $this->key = mb_substr($notation, 2, mb_strpos($notation, '(') - 2);

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
