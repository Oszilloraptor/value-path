<?php

declare(strict_types=1);

namespace Rikta\ValuePath;

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
interface ValuePathInterface
{
    public function __invoke($item);
}
