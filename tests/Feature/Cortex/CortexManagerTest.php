<?php

use Manik\Cortex\Facades\Cortex;

it('resolves LLM drivers through facade', function () {
    Cortex::fake();

    expect(Cortex::llm())->toBeInstanceOf(\Manik\Cortex\Contracts\LLMDriver::class);
});

it('resolves embedding drivers through facade', function () {
    Cortex::fake();

    expect(Cortex::embedding())->toBeInstanceOf(\Manik\Cortex\Contracts\EmbeddingDriver::class);
});

it('resolves vector drivers through facade', function () {
    expect(Cortex::vector())->toBeInstanceOf(\Manik\Cortex\Contracts\VectorDriver::class);
});

it('resolves image driver through facade', function () {
    Http::fake([
        'api.openai.com/*' => Http::response(['data' => [['url' => 'https://example.com/image.png', 'revised_prompt' => 'test']]]),
    ]);

    $result = Cortex::image();

    expect($result)->toBeArray();
});

it('resolves speech driver through facade', function () {
    Http::fake([
        'api.openai.com/*' => Http::response('audio content', 200, ['Content-Type' => 'audio/mpeg']),
    ]);

    $result = Cortex::speech();

    expect($result)->toBeString();
});

it('returns RAG manager', function () {
    expect(Cortex::rag())->toBeInstanceOf(\Manik\Cortex\RAG\RAGManager::class);
});

it('returns memory manager', function () {
    expect(Cortex::memory())->toBeInstanceOf(\Manik\Cortex\Memory\MemoryManager::class);
});

it('creates agent through facade', function () {
    Cortex::fake();

    expect(Cortex::agent())->toBeInstanceOf(\Manik\Cortex\Agent\Agent::class);
});
