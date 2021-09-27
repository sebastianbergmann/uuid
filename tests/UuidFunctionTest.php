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
 * @covers ::\SebastianBergmann\Uuid\uuid
 *
 * @small
 */
final class UuidFunctionTest extends TestCase
{
    public function testGeneratesUuid(): void
    {
        $this->assertStringIsUuid(uuid());
    }

    private function assertStringIsUuid(string $string): void
    {
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/',
            $string
        );
    }
}
