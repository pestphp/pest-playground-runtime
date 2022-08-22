<?php

declare(strict_types=1);

namespace PestPlayground\Runtime\Contracts\Actions;

use PestPlayground\Runtime\Support\Output;

interface RunsPestTests
{
    public function __invoke(): Output;
}
