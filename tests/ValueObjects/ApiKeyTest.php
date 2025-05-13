<?php

namespace Tests\ValueObjects;

use TogetherAI\Client\Tests\TestCase;
use TogetherAI\ValueObjects\ApiKey;

class ApiKeyTest extends TestCase
{
    /** @test */
    public function it_can_create_api_key_from_string()
    {
        $apiKey = ApiKey::from('api-key');

        $this->assertEquals('api-key', $apiKey->toString());
    }
}
