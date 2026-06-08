<?php

use Manik\Neuro\Facades\Neuro;

beforeEach(function () {
    Neuro::fake();
});

it('returns fake chat response', function () {
    $response = Neuro::chat()
        ->message('Test message')
        ->chat();

    expect($response)
        ->toHaveKey('content')
        ->toHaveKey('role')
        ->and($response['content'])->toBe('fake response');
});

it('returns fake stream response', function () {
    $stream = Neuro::chat()
        ->message('Test')
        ->stream();

    $output = '';
    foreach ($stream as $chunk) {
        $output .= $chunk['content'];
    }

    expect($output)->toBe('fake response');
});

it('returns fake embedding when faked', function () {
    $result = Neuro::chat()
        ->text('Test text')
        ->embed('openai');

    expect($result)
        ->toHaveKey('embedding')
        ->toHaveKey('dimensions')
        ->and($result['dimensions'])->toBe(1536)
        ->and(count($result['embedding']))->toBe(1536);
});

it('passes through the facade root', function () {
    $client = Neuro::chat();

    expect($client)->toBeInstanceOf(\Manik\Neuro\AIClient::class);
});
