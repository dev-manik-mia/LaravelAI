<?php

use Illuminate\Support\Facades\Http;
use Manik\Cortex\Facades\Cortex;

beforeEach(function () {
    Http::fake([
        'api.openai.com/*' => Http::response('audio content', 200, ['Content-Type' => 'audio/mpeg']),
    ]);
});

it('resolves speech driver through facade', function () {
    $result = Cortex::speech();

    expect($result)->toBeString();
});

it('speech driver has correct default model', function () {
    $manager = app(\Manik\Cortex\Speech\SpeechManager::class);
    $driver = $manager->driver();

    expect($driver->getModel())->toBe('tts-1');
});

it('speech driver can set model', function () {
    $manager = app(\Manik\Cortex\Speech\SpeechManager::class);
    $driver = $manager->driver();
    $driver->setModel('tts-1-hd');

    expect($driver->getModel())->toBe('tts-1-hd');
});
