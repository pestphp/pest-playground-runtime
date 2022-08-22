<?php

declare(strict_types=1);

namespace PestPlayground\Runtime;

use PestPlayground\Runtime\Actions\ConvertAnsiToHtml;
use PestPlayground\Runtime\Actions\CreateUserFiles;
use PestPlayground\Runtime\Actions\RunPestTests;
use PestPlayground\Runtime\Contracts\Actions\ConvertsAnsiToHtml;
use PestPlayground\Runtime\Contracts\Actions\CreatesUserFiles;
use PestPlayground\Runtime\Contracts\Actions\RunsPestTests;
use PestPlayground\Runtime\Contracts\Environment;
use PestPlayground\Runtime\Support\Output;

final class Handler
{
    private readonly CreatesUserFiles $createUserFiles;

    private readonly RunsPestTests $runPestTests;

    private readonly ConvertsAnsiToHtml $convertAnsiToHtml;

    public function __construct(
        private readonly array $event,
        private readonly Environment $environment,
        CreatesUserFiles|null $createUserFiles = null,
        RunsPestTests|null $runPestTests = null,
        ConvertsAnsiToHtml|null $convertAnsiToHtml = null,
    ) {
        $this->createUserFiles = $createUserFiles ?? new CreateUserFiles($this->environment);
        $this->runPestTests = $runPestTests ?? new RunPestTests($this->environment);
        $this->convertAnsiToHtml = $convertAnsiToHtml ?? new ConvertAnsiToHtml($this->environment);
    }

    public function handle(): Output
    {
        $this->environment->setup();

        ($this->createUserFiles)($this->event['files']);
        $pestOutput = ($this->runPestTests)();

        $this->environment->teardown();

        return ($this->convertAnsiToHtml)($pestOutput);
    }
}
