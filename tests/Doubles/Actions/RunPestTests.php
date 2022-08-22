<?php

declare(strict_types=1);

namespace Tests\Doubles\Actions;

use PestPlayground\Runtime\Contracts\Actions\RunsPestTests;
use PestPlayground\Runtime\Support\Output;
use PHPUnit\Framework\Assert;

final class RunPestTests implements RunsPestTests
{
    private bool $testsHaveRun = false;

    public function __construct(
        private readonly int $exitCode = 0,
        private readonly string $output = '',
        private readonly string $errors = '',
    ) {
    }

    public function __invoke(): Output
    {
        $this->testsHaveRun = true;

        return new Output(
            $this->exitCode,
            $this->output,
            $this->errors,
        );
    }

    public function assertTestsHaveRun(): void
    {
        Assert::assertTrue($this->testsHaveRun, 'The tests were never executed!');
    }
}
