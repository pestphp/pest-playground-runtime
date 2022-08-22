<?php

declare(strict_types=1);

namespace PestPlayground\Runtime\Support;

use JsonSerializable;

final class Output implements JsonSerializable
{
    public function __construct(
        public readonly int $exitCode,
        public readonly string $output,
        public readonly string $errors,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return [
            'exitCode' => $this->exitCode,
            'output' => $this->output,
            'errors' => $this->errors,
        ];
    }
}
