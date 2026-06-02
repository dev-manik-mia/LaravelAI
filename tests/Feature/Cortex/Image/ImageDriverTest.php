<?php

use Illuminate\Support\Facades\Http;
use Manik\Cortex\Facades\Cortex;

beforeEach(function () {
    Http::fake([
        'api.openai.com/*' => Http::response(['data' => [['url' => 'https://example.com/image.png', 'revised_prompt' => 'test']]]),
    ]);
});

it('resolves image driver through facade', function () {
    $result = Cortex::image();

    expect($result)->toBeArray()
        ->toHaveKey('url')
        ->toHaveKey('revised_prompt');
});

it('image driver has correct default model', function () {
    $manager = app(\Manik\Cortex\Image\ImageManager::class);
    $driver = $manager->driver();

    expect($driver->getModel())->toBe('dall-e-3');
});

it('image driver can set model', function () {
    $manager = app(\Manik\Cortex\Image\ImageManager::class);
    $driver = $manager->driver();
    $driver->setModel('dall-e-2');

    expect($driver->getModel())->toBe('dall-e-2');
});
