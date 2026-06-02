<?php

use Manik\Cortex\Facades\Cortex;

it('can create a pipeline via RAG manager', function () {
    $pipeline = Cortex::rag()->pipeline();

    expect($pipeline)->toBeInstanceOf(\Manik\Cortex\RAG\RAGPipeline::class);
});

it('can configure pipeline parameters', function () {
    $pipeline = Cortex::rag()->pipeline();

    $result = $pipeline
        ->collection('docs')
        ->question('Test question')
        ->topK(10)
        ->minScore(0.5);

    expect($result)->toBeInstanceOf(\Manik\Cortex\RAG\RAGPipeline::class);
});

it('can create document ingestion', function () {
    $ingestion = Cortex::rag()->ingestion();

    expect($ingestion)->toBeInstanceOf(\Manik\Cortex\RAG\Ingestion\DocumentIngestion::class);
});
