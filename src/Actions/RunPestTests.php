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
            $this->fileSystem->projectRoot(),
            $this->hiddenEnvironmentVariables(),
        );

        $process->run();

        return new Output($process->getExitCode(), $process->getOutput(), $process->getErrorOutput());
    }

    /**
     * @return array<string, false>
     */
    private function hiddenEnvironmentVariables(): array
    {
        return [
            '_AWS_XRAY_DAEMON_ADDRESS' => false,
            '_AWS_XRAY_DAEMON_PORT' => false,
            '_HANDLER' => false,
            'AWS_ACCESS_KEY_ID' => false,
            'AWS_DEFAULT_REGION' => false,
            'AWS_LAMBDA_FUNCTION_NAME' => false,
            'AWS_LAMBDA_FUNCTION_VERSION' => false,
            'AWS_LAMBDA_FUNCTION_MEMORY_SIZE' => false,
            'AWS_LAMBDA_INITIALIZATION_TYPE' => false,
            'AWS_LAMBDA_LOG_GROUP_NAME' => false,
            'AWS_LAMBDA_LOG_STREAM_NAME' => false,
            'AWS_LAMBDA_RUNTIME_API' => false,
            'AWS_REGION' => false,
            'AWS_REQUEST_ID' => false,
            'AWS_SECRET_ACCESS_KEY' => false,
            'AWS_SESSION_TOKEN' => false,
            'AWS_XRAY_CONTEXT_MISSING' => false,
            'AWS_XRAY_DAEMON_ADDRESS' => false,
            'EVALUATOR_DRIVER' => false,
            'LAMBDA_RUNTIME_DIR' => false,
            'LAMBDA_TASK_ROOT' => false,
            'LANG' => false,
            'SHLVL' => false,
            'SIDECAR_CHECKSUM' => false,
        ];
    }
}
