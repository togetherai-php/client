<?php

namespace TogetherAI\Client\Tests\Concerns;

trait InteractsWithFiles
{
    public function fileResourceResource()
    {
        return fopen(__DIR__.'/../Fixtures/MyFile.jsonl', 'r');
    }
}
