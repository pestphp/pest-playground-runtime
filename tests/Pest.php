<?php

use PestPlayground\Runtime\Contracts\Actions\ConvertsAnsiToHtml;
use PestPlayground\Runtime\Contracts\Actions\CreatesUserFiles;
use PestPlayground\Runtime\Contracts\Actions\RunsPestTests;
use PestPlayground\Runtime\Handler;
use PestPlayground\Runtime\Support\Output;
use Tests\Doubles\Actions\RunPestTests;
use Tests\Doubles\TestEnvironment;

function handle(
    array $event,
    CreatesUserFiles $createUserFiles = null,
    RunsPestTests $runPestTests = null,
    ConvertsAnsiToHtml $convertAnsiToHtml = null,
    Closure $beforeTeardown = null,
): Output {
    $handler = new Handler(
        $event,
        new TestEnvironment($beforeTeardown),
        $createUserFiles,
        $runPestTests ?? new RunPestTests(),
        $convertAnsiToHtml,
    );

    return $handler->handle();
}
