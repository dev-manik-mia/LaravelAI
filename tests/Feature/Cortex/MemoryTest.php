<?php

it('uses session memory driver', function () {
    $memory = app(\Manik\Cortex\Memory\MemoryManager::class);

    $memory->driver('session')->add('session-1', ['role' => 'user', 'content' => 'Hello']);
    $memory->driver('session')->add('session-1', ['role' => 'assistant', 'content' => 'Hi there']);

    $history = $memory->driver('session')->get('session-1');

    expect($history)->toBeArray()->toHaveCount(2);
});

it('conversation memory adds and retrieves messages', function () {
    $memory = app(\Manik\Cortex\Memory\MemoryManager::class);

    $memory->driver('conversation')->add('conv-1', ['role' => 'user', 'content' => 'Hello']);
    $memory->driver('conversation')->add('conv-1', ['role' => 'assistant', 'content' => 'Hi there']);

    $history = $memory->driver('conversation')->get('conv-1');

    expect($history)->toBeArray()->toHaveCount(2)
        ->and($history[0]['role'])->toBe('user')
        ->and($history[0]['content'])->toBe('Hello');
});

it('conversation memory respects limit', function () {
    $memory = app(\Manik\Cortex\Memory\MemoryManager::class);

    for ($i = 1; $i <= 5; $i++) {
        $memory->driver('conversation')->add('conv-limit', ['role' => 'user', 'content' => "Message {$i}"]);
    }

    $history = $memory->driver('conversation')->get('conv-limit');

    expect($history)->toHaveCount(5);
});

it('conversation memory clears session', function () {
    $memory = app(\Manik\Cortex\Memory\MemoryManager::class);

    $memory->driver('conversation')->add('conv-clear', ['role' => 'user', 'content' => 'Test']);
    $memory->driver('conversation')->clear('conv-clear');

    $history = $memory->driver('conversation')->get('conv-clear');

    expect($history)->toBeEmpty();
});
