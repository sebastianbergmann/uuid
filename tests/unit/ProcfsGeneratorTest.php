<?php declare(strict_types=1);
/*
 * This file is part of sebastian/uuid.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Uuid;

use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\Uuid\ProcfsGenerator
 *
 * @small
 */
final class ProcfsGeneratorTest extends TestCase
{
    use UuidAssertionTrait;

    /**
     * @testdox Generates UUID using /proc/sys/kernel/random/uuid
     */
    public function testGeneratesUuidUsingProcfs(): void
    {
        if (!is_file('/proc/sys/kernel/random/uuid')) {
            $this->markTestSkipped('/proc/sys/kernel/random/uuid is not available');
        }

        $this->assertStringIsUuid(
            (new ProcfsGenerator)->generate()
        );
    }
}
