<?php

use Manik\Neuro\Facades\Neuro;

beforeEach(function () {
    Neuro::fake();
});

it('can register a tool', function () {
    $agent = Neuro::agent()
        ->tool('get_time', fn () => '12:00', 'Get the current time');

    expect($agent)->toBeInstanceOf(\Manik\Neuro\Agent\Agent::class);
});

it('can register multiple tools at once', function () {
    $agent = Neuro::agent()
        ->tools([
            ['name' => 'tool_a', 'fn' => fn () => 'a', 'description' => 'Tool A'],
            ['name' => 'tool_b', 'fn' => fn () => 'b', 'description' => 'Tool B'],
        ]);

    expect($agent)->toBeInstanceOf(\Manik\Neuro\Agent\Agent::class);
});

it('can set session and max steps', function () {
    $agent = Neuro::agent()
        ->session('user-123')
        ->maxSteps(5);

    expect($agent)->toBeInstanceOf(\Manik\Neuro\Agent\Agent::class);
});

it('runs a task and returns response', function () {
    $result = Neuro::agent()
        ->run('What is 2+2?');

    expect($result)
        ->toHaveKey('response')
        ->toHaveKey('steps')
        ->toHaveKey('tokens')
        ->and($result['response'])->toBe('fake response')
        ->and($result['steps'])->toBe(1);
});
