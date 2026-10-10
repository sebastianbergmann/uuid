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

use function hex2bin;
use function str_repeat;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversFunction;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Small;
use PHPUnit\Framework\TestCase;

#[CoversFunction('SebastianBergmann\Uuid\uuid')]
#[CoversFunction('SebastianBergmann\Uuid\uuidFromBytes')]
#[CoversClass(InvalidArgumentException::class)]
#[Small]
final class UuidTest extends TestCase
{
    /**
     * @return array<string, array{int}>
     */
    public static function versionProvider(): array
    {
        return [
            'version 1' => [1],
            'version 2' => [2],
            'version 3' => [3],
            'version 4' => [4],
            'version 5' => [5],
            'version 6' => [6],
            'version 7' => [7],
            'version 8' => [8],
        ];
    }

    /**
     * @return array<string, array{int}>
     */
    public static function invalidVersionProvider(): array
    {
        return [
            'zero'        => [0],
            'more than 8' => [9],
            'negative'    => [-4],
        ];
    }

    public function testGeneratesRandomUuidOfVersion4(): void
    {
        $a = uuid();
        $b = uuid();

        $this->assertStringIsUuid($a, 4);
        $this->assertStringIsUuid($b, 4);
        $this->assertNotSame($a, $b);
    }

    #[DataProvider('versionProvider')]
    public function testCreatesUuidOfGivenVersionFromBytes(int $version): void
    {
        $this->assertStringIsUuid(uuidFromBytes(str_repeat("\xA5", 16), $version), $version);
    }

    public function testSetsTheBitsOfTheVersionAndTheVariantAndKeepsAllOtherBits(): void
    {
        $this->assertSame('00000000-0000-4000-8000-000000000000', uuidFromBytes(str_repeat("\x00", 16), 4));
        $this->assertSame('ffffffff-ffff-7fff-bfff-ffffffffffff', uuidFromBytes(str_repeat("\xFF", 16), 7));
        $this->assertSame('01234567-89ab-1def-8123-456789abcdef', uuidFromBytes((string) hex2bin('0123456789abcdef0123456789abcdef'), 1));
    }

    public function testBytesMustBeSixteenBytes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('A UUID consists of 16 bytes, 15 bytes were given');

        uuidFromBytes(str_repeat("\x00", 15), 4);
    }

    #[DataProvider('invalidVersionProvider')]
    public function testVersionMustBeFromOneToEight(int $version): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The version of a UUID must be from 1 to 8, ' . $version . ' was given');

        uuidFromBytes(str_repeat("\x00", 16), $version);
    }

    private function assertStringIsUuid(string $string, int $version): void
    {
        $this->assertMatchesRegularExpression(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-' . $version . '[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/',
            $string,
        );
    }
}
