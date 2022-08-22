<?php

declare(strict_types=1);

namespace Tests\Doubles;

use Closure;
use PestPlayground\Runtime\Contracts\Environment;

final class TestEnvironment implements Environment
{
    public function __construct(private readonly Closure|null $beforeTeardownHook = null)
    {
    }

    public function setup(): void
    {
    }

    public function teardown(): void
    {
        $this->beforeTeardownHook?->__invoke();

        exec("rm -rf {$this->projectRoot()}/tests");
        exec("rm -rf {$this->projectRoot()}/app");
    }

    public function phpBinary(): string
    {
        return PHP_BINARY;
    }

    public function projectRoot(): string
    {
        return __DIR__.'/../test-environment';
    }

    public function supportsAnsiToHtml(): bool
    {
        return false;
    }
}
