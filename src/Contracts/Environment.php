<?php

declare(strict_types=1);

namespace PestPlayground\Runtime\Contracts;

interface Environment
{
    public function setup(): void;

    public function teardown(): void;

    public function phpBinary(): string;

    public function projectRoot(): string;

    public function supportsAnsiToHtml(): bool;
}
