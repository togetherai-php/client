<?php

namespace TogetherAI\Client\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use TogetherAI\Client\Tests\Concerns\InteractsWithFiles;
use TogetherAI\Client\Tests\Concerns\MocksTogetherAIClient;

class TestCase extends BaseTestCase
{
    use InteractsWithFiles;
    use MocksTogetherAIClient;

    //
}
