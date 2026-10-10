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

use function bin2hex;
use function chr;
use function ord;
use function random_bytes;
use function sprintf;
use function strlen;
use function substr;

/**
 * Returns a random UUID of version 4.
 *
 * @no-named-arguments
 *
 * @return non-empty-string
 */
function uuid(): string
{
    /** @noinspection PhpUnhandledExceptionInspection */
    return uuidFromBytes(random_bytes(16), 4);
}

/**
 * Returns the UUID of the given version (RFC 9562) that consists of the given
 * 16 bytes, except for the bits of its version and its variant, which are set
 * accordingly, in its canonical form: 32 lowercase hexadecimal digits in five
 * groups of 8, 4, 4, 4, and 12 digits.
 *
 * @no-named-arguments
 *
 * @throws InvalidArgumentException when $bytes does not consist of 16 bytes or $version is not from 1 to 8
 *
 * @return non-empty-string
 */
function uuidFromBytes(string $bytes, int $version): string
{
    if (strlen($bytes) !== 16) {
        throw new InvalidArgumentException(
            sprintf(
                'A UUID consists of 16 bytes, %d bytes were given',
                strlen($bytes),
            ),
        );
    }

    if ($version < 1 || $version > 8) {
        throw new InvalidArgumentException(
            sprintf(
                'The version of a UUID must be from 1 to 8, %d was given',
                $version,
            ),
        );
    }

    $bytes[6] = chr(ord($bytes[6]) & 0x0F | $version << 4);
    $bytes[8] = chr(ord($bytes[8]) & 0x3F | 0x80);

    $hexadecimal = bin2hex($bytes);

    return sprintf(
        '%s-%s-%s-%s-%s',
        substr($hexadecimal, 0, 8),
        substr($hexadecimal, 8, 4),
        substr($hexadecimal, 12, 4),
        substr($hexadecimal, 16, 4),
        substr($hexadecimal, 20, 12),
    );
}
