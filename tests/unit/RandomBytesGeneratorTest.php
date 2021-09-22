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
 * @covers \SebastianBergmann\Uuid\RandomBytesGenerator
 *
 * @small
 */
final class RandomBytesGeneratorTest extends TestCase
{
    use UuidAssertionTrait;

    /**
     * @testdox Generates UUID using random_bytes()
     */
    public function testGeneratesUuidUsingProcfs(): void
    {
        $this->assertStringIsUuid(
            (new RandomBytesGenerator)->generate()
        );
    }
}
