<?php

declare(strict_types=1);

namespace PestPlayground\Runtime\Actions;

use PestPlayground\Runtime\Contracts\Actions\ConvertsAnsiToHtml;
use PestPlayground\Runtime\Contracts\Environment;
use PestPlayground\Runtime\Support\Output;

final class ConvertAnsiToHtml implements ConvertsAnsiToHtml
{
    public function __construct(private readonly Environment $fileSystem)
    {
    }

    public function __invoke(Output $output): Output
    {
        return new Output(
            $output->exitCode,
            $this->convert($output->output),
            $this->convert($output->errors),
        );
    }

    private function convert(string $content): string
    {
        /**
         * If we're on a local system, the bundled terminal-to-html
         * utility is unlikely to work. Instead, we'll just send
         * back the unaltered content, which is better than an
         * error.
         */
        if (! $this->fileSystem->supportsAnsiToHtml()) {
            return $content;
        }

        $output = [];
        $terminalToHtmlPath = __DIR__.'/../../terminal-to-html';
        exec("echo \"{$content}\" | {$terminalToHtmlPath}", $output);

        return implode('<br/>', $output);
    }
}
