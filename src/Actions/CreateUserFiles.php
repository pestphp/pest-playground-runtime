<?php

declare(strict_types=1);

namespace PestPlayground\Runtime\Actions;

use PestPlayground\Runtime\Contracts\Actions\CreatesUserFiles;
use PestPlayground\Runtime\Contracts\Environment;
use PestPlayground\Runtime\Support\Str;

final class CreateUserFiles implements CreatesUserFiles
{
    public function __construct(private readonly Environment $fileSystem)
    {
    }

    public function __invoke(array $files): void
    {
        foreach ($files as $details) {
            $filename = $details['name'];
            $parentDirectory = Str::beforeLast('/', "{$this->fileSystem->projectRoot()}/{$filename}");

            if (! file_exists($parentDirectory)) {
                mkdir($parentDirectory, recursive: true);
            }

            file_put_contents("{$this->fileSystem->projectRoot()}/{$filename}", base64_decode($details['content']));
        }
    }
}
