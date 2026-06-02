<?php

use Manik\Cortex\Facades\Cortex;

beforeEach(function () {
    Cortex::fake();
});

it('can register a tool', function () {
    $agent = Cortex::agent()
        ->tool('get_time', fn () => '12:00', 'Get the current time');

    expect($agent)->toBeInstanceOf(\Manik\Cortex\Agent\Agent::class);
});

it('can register multiple tools at once', function () {
    $agent = Cortex::agent()
        ->tools([
            ['name' => 'tool_a', 'fn' => fn () => 'a', 'description' => 'Tool A'],
            ['name' => 'tool_b', 'fn' => fn () => 'b', 'description' => 'Tool B'],
        ]);

    expect($agent)->toBeInstanceOf(\Manik\Cortex\Agent\Agent::class);
});

it('can set session and max steps', function () {
    $agent = Cortex::agent()
        ->session('user-123')
        ->maxSteps(5);

    expect($agent)->toBeInstanceOf(\Manik\Cortex\Agent\Agent::class);
});

it('runs a task and returns response', function () {
    $result = Cortex::agent()
        ->run('What is 2+2?');

    expect($result)
        ->toHaveKey('response')
        ->toHaveKey('steps')
        ->toHaveKey('tokens')
        ->and($result['response'])->toBe('fake response')
        ->and($result['steps'])->toBe(1);
});
