<?php

namespace TogetherAI\Tests;

use TogetherAI\Client;
use TogetherAI\Client\Tests\TestCase;

class TogetherAITest extends TestCase
{
    /** @test */
    public function it_creates_a_client()
    {
        $togetherAI = \TogetherAI::client('api-key');

        $this->assertInstanceOf(Client::class, $togetherAI);
    }
}
