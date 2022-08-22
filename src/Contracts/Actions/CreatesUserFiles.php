<?php

namespace PestPlayground\Runtime\Contracts\Actions;

interface CreatesUserFiles
{
    /**
     * @param  array<int, array{content: string, name: string}>  $files
     */
    public function __invoke(array $files): void;
}
