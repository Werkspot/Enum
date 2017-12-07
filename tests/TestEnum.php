<?php

declare(strict_types=1);

namespace Werkspot\Enum\Tests;

use Werkspot\Enum\AbstractEnum;

/**
 * @method static TestEnum a()
 * @method static TestEnum b()
 * @method static TestEnum a1()
 * @method static TestEnum a3()
 * @method static TestEnum anull()
 * @method static TestEnum nameWithUnderscore()
 */
class TestEnum extends AbstractEnum
{
    const A = 'A';
    const B = 'BEE';
    const A1 = 1;
    const A3 = 3;
    const ANULL = null;
    const NAME_WITH_UNDERSCORE = true;
}
