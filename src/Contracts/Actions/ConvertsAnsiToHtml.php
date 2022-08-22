<?php

namespace PestPlayground\Runtime\Contracts\Actions;

use PestPlayground\Runtime\Support\Output;

interface ConvertsAnsiToHtml
{
    public function __invoke(Output $output): Output;
}
