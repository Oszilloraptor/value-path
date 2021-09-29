<?php

declare(strict_types=1);

namespace Rikta\ValuePath\Tests;

use PHPUnit\Framework\TestCase;
use Rikta\ValuePath\ValuePath;

/**
 * @internal
 *
 * @small
 */
final class FunctionalTest extends TestCase
{
    /** @test */
    public function getsExpectedValue(): void
    {
        $data = require __DIR__.'/data.php';
        $path = new ValuePath('.janitor->getInfo("contact")->getPhoneNumbers()[0]->number');
        $phone = $path($data);
        self::assertSame('+49301234567', $phone);
    }
}
