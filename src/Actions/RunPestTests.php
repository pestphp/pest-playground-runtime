<?php

declare(strict_types=1);

namespace PestPlayground\Runtime\Actions;

use PestPlayground\Runtime\Contracts\Actions\RunsPestTests;
use PestPlayground\Runtime\Contracts\Environment;
use PestPlayground\Runtime\Support\Output;
use Symfony\Component\Process\Process;

final class RunPestTests implements RunsPestTests
{
    public function __construct(private readonly Environment $fileSystem)
    {
    }

    public function __invoke(): Output
    {
        $process = new Process(
            [$this->fileSystem->phpBinary(), 'vendor/bin/pest'],
            $this->fileSystem->projectRoot()
        );

        $process->run();

        return new Output($process->getExitCode(), $process->getOutput(), $process->getErrorOutput());
    }
}
