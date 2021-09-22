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

/**
 * @internal
 */
final class Registry
{
    private static ?Generator $generator = null;

    public static function generator(): Generator
    {
        if (self::$generator === null) {
            self::$generator = self::selectImplementation();
        }

        return self::$generator;
    }

    private static function selectImplementation(): Generator
    {
        if (is_file('/proc/sys/kernel/random/uuid')) {
            return new ProcfsGenerator;
        }

        return new RandomBytesGenerator;
    }
}
