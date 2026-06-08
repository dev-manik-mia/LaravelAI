<?php

use Manik\Neuro\Facades\Neuro;

it('resolves LLM drivers through facade', function () {
    Neuro::fake();

    expect(Neuro::llm())->toBeInstanceOf(\Manik\Neuro\Contracts\LLMDriver::class);
});

it('resolves embedding drivers through facade', function () {
    Neuro::fake();

    expect(Neuro::embedding())->toBeInstanceOf(\Manik\Neuro\Contracts\EmbeddingDriver::class);
});

it('resolves vector drivers through facade', function () {
    expect(Neuro::vector())->toBeInstanceOf(\Manik\Neuro\Contracts\VectorDriver::class);
});

it('resolves image driver through facade', function () {
    Http::fake([
        'api.openai.com/*' => Http::response(['data' => [['url' => 'https://example.com/image.png', 'revised_prompt' => 'test']]]),
    ]);

    $result = Neuro::image();

    expect($result)->toBeArray();
});

it('resolves speech driver through facade', function () {
    Http::fake([
        'api.openai.com/*' => Http::response('audio content', 200, ['Content-Type' => 'audio/mpeg']),
    ]);

    $result = Neuro::speech();

    expect($result)->toBeString();
});

it('returns RAG manager', function () {
    expect(Neuro::rag())->toBeInstanceOf(\Manik\Neuro\RAG\RAGManager::class);
});

it('returns memory manager', function () {
    expect(Neuro::memory())->toBeInstanceOf(\Manik\Neuro\Memory\MemoryManager::class);
});

it('creates agent through facade', function () {
    Neuro::fake();

    expect(Neuro::agent())->toBeInstanceOf(\Manik\Neuro\Agent\Agent::class);
});
