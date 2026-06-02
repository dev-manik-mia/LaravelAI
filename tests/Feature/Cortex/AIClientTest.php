<?php

use Manik\Cortex\Facades\Cortex;

beforeEach(function () {
    Cortex::fake();
});

it('returns fake chat response', function () {
    $response = Cortex::chat()
        ->message('Test message')
        ->chat();

    expect($response)
        ->toHaveKey('content')
        ->toHaveKey('role')
        ->and($response['content'])->toBe('fake response');
});

it('returns fake stream response', function () {
    $stream = Cortex::chat()
        ->message('Test')
        ->stream();

    $output = '';
    foreach ($stream as $chunk) {
        $output .= $chunk['content'];
    }

    expect($output)->toBe('fake response');
});

it('returns fake embedding when faked', function () {
    $result = Cortex::chat()
        ->text('Test text')
        ->embed('openai');

    expect($result)
        ->toHaveKey('embedding')
        ->toHaveKey('dimensions')
        ->and($result['dimensions'])->toBe(1536)
        ->and(count($result['embedding']))->toBe(1536);
});

it('passes through the facade root', function () {
    $client = Cortex::chat();

    expect($client)->toBeInstanceOf(\Manik\Cortex\AIClient::class);
});
