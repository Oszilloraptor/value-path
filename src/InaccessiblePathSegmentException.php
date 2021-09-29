<?php

declare(strict_types=1);

namespace Rikta\ValuePath;

use OutOfBoundsException;
use Rikta\ValuePath\Segment\PathSegmentInterface;

class InaccessiblePathSegmentException extends OutOfBoundsException
{
    public function __construct(PathSegmentInterface $segment, $value, $path)
    {
        parent::__construct(sprintf(
            'Cannot access `%s` (of Path `%s`) on `%s` (%s)',
            $segment->getNotation(),
            $path,
            \get_class($value),
            var_export($value, true),
        ));
    }
}
