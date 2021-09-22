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

use function file_get_contents;
use function trim;

/**
 * @internal
 */
final class ProcfsGenerator implements Generator
{
    public function generate(): string
    {
        return trim(file_get_contents('/proc/sys/kernel/random/uuid'));
    }
}
