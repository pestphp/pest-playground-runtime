<?php

declare(strict_types=1);

use Tests\Doubles\Actions\ConvertAnsiToHtml;
use Tests\Doubles\Actions\RunPestTests;

it('creates files correctly', function () {
    $fileName = 'tests/ExampleTest.php';
    expect(__DIR__."/../test-environment/{$fileName}")->not->toBeFile();

    $event = [
        'files' => [
            [
                'name' => $fileName,
                'content' => '<?php',
            ],
        ],
    ];

    handle($event, beforeTeardown: function () use ($fileName) {
        expect(__DIR__."/../test-environment/{$fileName}")->toBeFile();
    });
});

it('it runs pest tests', function () {
    $runPestTests = new RunPestTests();

    handle(
        ['files' => [
            [
                'name' => 'tests/FooBarTest.php',
                'content' => '<?php',
            ],
        ]],
        runPestTests: $runPestTests
    );

    $runPestTests->assertTestsHaveRun();
});

it('converts ANSI to HTML', function () {
    $convertAnsiToHtml = new ConvertAnsiToHtml();

    handle(
        ['files' => [
            [
                'name' => 'tests/FooBarTest.php',
                'content' => '<?php',
            ],
        ]],
        convertAnsiToHtml: $convertAnsiToHtml
    );

    $convertAnsiToHtml->assertConverted();
});
