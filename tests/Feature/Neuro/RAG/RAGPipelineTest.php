<?php

use Manik\Neuro\Facades\Neuro;

it('can create a pipeline via RAG manager', function () {
    $pipeline = Neuro::rag()->pipeline();

    expect($pipeline)->toBeInstanceOf(\Manik\Neuro\RAG\RAGPipeline::class);
});

it('can configure pipeline parameters', function () {
    $pipeline = Neuro::rag()->pipeline();

    $result = $pipeline
        ->collection('docs')
        ->question('Test question')
        ->topK(10)
        ->minScore(0.5);

    expect($result)->toBeInstanceOf(\Manik\Neuro\RAG\RAGPipeline::class);
});

it('can create document ingestion', function () {
    $ingestion = Neuro::rag()->ingestion();

    expect($ingestion)->toBeInstanceOf(\Manik\Neuro\RAG\Ingestion\DocumentIngestion::class);
});
