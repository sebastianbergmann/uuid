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

use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversFunction('SebastianBergmann\Uuid\uuid')]
#[Small]
final class UuidTest extends TestCase
{
    public function testGeneratesUuid(): void
    {
        $a = uuid();
        $b = uuid();

        $this->assertStringIsUuid($a);
        $this->assertStringIsUuid($b);
        $this->assertNotSame($a, $b);
    }

    private function assertStringIsUuid(string $string): void
    {
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/',
            $string
        );
    }
}
