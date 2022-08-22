<?php

declare(strict_types=1);

namespace Tests\Doubles\Actions;

use PestPlayground\Runtime\Contracts\Actions\ConvertsAnsiToHtml;
use PestPlayground\Runtime\Support\Output;
use PHPUnit\Framework\Assert;

final class ConvertAnsiToHtml implements ConvertsAnsiToHtml
{
    private bool $wasConverted = false;

    public function __invoke(Output $output): Output
    {
        $this->wasConverted = true;

        return $output;
    }

    public function assertConverted(): void
    {
        Assert::assertTrue($this->wasConverted, 'ANSI was never converted to HTML');
    }
}