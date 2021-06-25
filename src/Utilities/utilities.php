<?php

namespace App\Utilities;

use function array_keys;
use function range;
use function count;

/**
 * Determine whether the given array is associative or not.
 *
 * @param array $arr
 *
 * @return bool
 */
function is_assoc(array $arr) : bool
{
    if (empty($arr)) {
        return false;
    }

    return array_keys($arr) !== range(0, count($arr) - 1);
}
