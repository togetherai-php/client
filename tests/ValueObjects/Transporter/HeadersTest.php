<?php

namespace Tests\ValueObjects\Transporter;

use TogetherAI\Client\Tests\TestCase;
use TogetherAI\Enums\ContentType;
use TogetherAI\ValueObjects\ApiKey;
use TogetherAI\ValueObjects\Transporter\Headers;

class HeadersTest extends TestCase
{
    /** @test */
    public function it_can_be_created_from_an_api_token(): void
    {
        $headers = Headers::withAuthorization(ApiKey::from('api-token'));

        $this->assertEquals([
            'Authorization' => 'Bearer api-token',
        ], $headers->toArray());
    }

    /** @test */
    public function it_can_have_content_or_type(): void
    {
        $headers = Headers::withAuthorization(ApiKey::from('api-key'))
            ->withContentType(ContentType::JSON);

        $expects = [
            'Authorization' => 'Bearer api-key',
            'Content-Type' => 'application/json',
        ];

        $this->assertEquals($expects, $headers->toArray());
    }

    /** @test */
    public function it_can_have_content_or_type_with_suffix(): void
    {
        $headers = Headers::withAuthorization(ApiKey::from('api-key'))
            ->withContentType(ContentType::MULTIPART, '; boundary=---XYZ');

        $expects = [
            'Authorization' => 'Bearer api-key',
            'Content-Type' => 'multipart/form-data; boundary=---XYZ',
        ];

        $this->assertEquals($expects, $headers->toArray());
    }

    /** @test */
    public function it_can_have_custom_header(): void
    {
        $headers = Headers::withAuthorization(ApiKey::from('api-key'))
            ->withContentType(ContentType::JSON)
            ->withCustomHeader('X-CUSTOM', 'value');

        $expects = [
            'Authorization' => 'Bearer api-key',
            'Content-Type' => 'application/json',
            'X-CUSTOM' => 'value',
        ];

        $this->assertEquals($expects, $headers->toArray());
    }
}
