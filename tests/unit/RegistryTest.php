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

use function is_file;
use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\Uuid\Registry
 *
 * @small
 */
final class RegistryTest extends TestCase
{
    public function testSelectsProcfsGeneratorWhenAvailable(): void
    {
        if (!is_file('/proc/sys/kernel/random/uuid')) {
            $this->markTestSkipped('/proc/sys/kernel/random/uuid is not available');
        }

        $this->assertInstanceOf(ProcfsGenerator::class, Registry::generator());
    }

    public function testSelectsRandomBytesGeneratorWhenProcfsGeneratorIsNotAvailable(): void
    {
        if (is_file('/proc/sys/kernel/random/uuid')) {
            $this->markTestSkipped('/proc/sys/kernel/random/uuid is available');
        }

        $this->assertInstanceOf(RandomBytesGenerator::class, Registry::generator());
    }
}
