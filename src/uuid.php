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
use function hexdec;
use function random_bytes;
use function sprintf;
use function substr;
use Throwable;

/**
 * @no-named-arguments
 *
 * @throws SourceOfRandomnessCannotBeFoundException
 */
function uuid(): string
{
    try {
        $bytes = random_bytes(16);
        // @codeCoverageIgnoreStart
    } catch (Throwable) {
        throw new SourceOfRandomnessCannotBeFoundException;
    }
    // @codeCoverageIgnoreEnd

    $bytes = bin2hex($bytes);

    return sprintf(
        '%08s-%04s-4%03s-%04x-%012s',
        substr($bytes, 0, 8),
        substr($bytes, 8, 4),
        substr($bytes, 13, 3),
        hexdec(substr($bytes, 16, 4)) & 0x3fff | 0x8000,
        substr($bytes, 20, 12)
    );
}
