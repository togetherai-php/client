<?php

namespace TogetherAI\Tests;

use GuzzleHttp\Client as GuzzleClient;
use TogetherAI;
use TogetherAI\Client;
use TogetherAI\Client\Tests\TestCase;

class TogetherAITest extends TestCase
{
    /** @test */
    public function it_creates_a_client(): void
    {
        $togetherAI = TogetherAI::client('api-key');

        $this->assertInstanceOf(Client::class, $togetherAI);
    }

    /** @test */
    public function it_creates_client_via_factory(): void
    {
        $togetherAI = TogetherAI::factory()
            ->withApiKey('api-key')
            ->make();

        $this->assertInstanceOf(Client::class, $togetherAI);
    }

    /** @test */
    public function it_sets_custom_client_via_factory(): void
    {
        $togetherAI = TogetherAI::factory()
            ->withHttpClient(new GuzzleClient)
            ->make();

        $this->assertInstanceOf(Client::class, $togetherAI);
    }

    /** @test */
    public function it_sets_custom_base_url_via_factory()
    {
        $togetherAI = TogetherAI::factory()
            ->withBaseUri('https://togetherai.example.com/v1')
            ->make();

        $this->assertInstanceOf(Client::class, $togetherAI);
    }

    /** @test */
    public function it_sets_header_via_factory()
    {
        $togetherAI = TogetherAI::factory()
            ->withHttpHeader('X-My-customer-header', 'custom-value')
            ->make();

        $this->assertInstanceOf(Client::class, $togetherAI);
    }

    /** @test */
    public function it_sets_custom_query_param_via_factory(): void
    {
        $togetherAI = TogetherAI::factory()
            ->withQueryParam('my-custom-param', 'my-custom-value')
            ->make();

        $this->assertInstanceOf(Client::class, $togetherAI);
    }
}
