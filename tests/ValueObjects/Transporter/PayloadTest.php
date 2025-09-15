<?php

namespace Tests\ValueObjects\Transporter;

use TogetherAI\Client\Tests\TestCase;
use TogetherAI\Enums\ContentType;
use TogetherAI\ValueObjects\ApiKey;
use TogetherAI\ValueObjects\Transporter\BaseUri;
use TogetherAI\ValueObjects\Transporter\Headers;
use TogetherAI\ValueObjects\Transporter\Payload;
use TogetherAI\ValueObjects\Transporter\QueryParams;

class PayloadTest extends TestCase
{
    /** @test */
    public function it_has_a_method(): void
    {
        $payload = Payload::create('models', []);

        $baseUri = BaseUri::from(baseUri: 'api.togetherai.xyz/v1');
        $headers = Headers::withAuthorization(apiKey: ApiKey::from('api-key'))
            ->withContentType(contentType: ContentType::JSON);
        $queryParams = QueryParams::create();

        $this->assertEquals(
            expected: 'POST',
            actual: $payload->toRequest(
                baseUri: $baseUri,
                headers: $headers,
                queryParams: $queryParams
            )->getMethod()
        );
    }

    /** @test */
    public function it_has_uri(): void
    {
        $payload = Payload::list('models');

        $baseUri = BaseUri::from('api.togetherai.xyz/v1');
        $headers = Headers::withAuthorization(ApiKey::from('api-key'))
            ->withContentType(ContentType::JSON);
        $queryParams = QueryParams::create()
            ->withParam('one', 'two')
            ->withParam('three', 'four');

        $uri = $payload->toRequest(
            baseUri: $baseUri,
            headers: $headers,
            queryParams: $queryParams
        )->getUri();

        $this->assertEquals('api.togetherai.xyz', $uri->getHost());
        $this->assertEquals('https', $uri->getScheme());
        $this->assertEquals('/v1/models', $uri->getPath());
        $this->assertEquals('one=two&three=four', $uri->getQuery());
    }

    /** @test */
    public function it_returns_empty_body_on_get_verb(): void
    {
        $payload = Payload::list('models');

        $baseUri = BaseUri::from('api.togetherai.xyz/v1');
        $headers = Headers::withAuthorization(ApiKey::from('api-key'))
            ->withContentType(ContentType::JSON);
        $queryParams = QueryParams::create();
        $body = $payload->toRequest(
            $baseUri,
            $headers,
            $queryParams
        )->getBody()
            ->getContents();

        $this->assertEquals('', $body);
    }

    /** @test */
    public function it_returns_filled_body_on_post_verb(): void
    {
        $payload = Payload::create('models', [
            'name' => 'Testing',
        ]);

        $baseUri = BaseUri::from('api.togetherai.xyz/v1');
        $headers = Headers::withAuthorization(ApiKey::from('api-key'))
            ->withContentType(ContentType::JSON);
        $queryPrams = QueryParams::create();

        $body = $payload->toRequest(
            baseUri: $baseUri,
            headers: $headers,
            queryParams: $queryPrams
        )->getBody()->getContents();

        $this->assertEquals(
            expected: json_encode(['name' => 'Testing']),
            actual: $body
        );

        $this->assertJson($body);
    }

    /** @test */
    public function it_builds_upload_request(): void
    {
        $this->markTestIncomplete();

        $payload = Payload::upload('files', [
            'purpose' => 'fine-tune',
            'file' => $this->fileResourceResource(),
        ]);

        $baseUri = BaseUri::from('api.togetherai.xyz/v1');
        $headers = Headers::withAuthorization(ApiKey::from('api-key'));
        $queryParams = QueryParams::create();

        $request = $payload->toRequest($baseUri, $headers, $queryParams);
        $header = $request->getHeader('Content-Type')[0];

        $this->assertEquals('/multipart\/form-data; boundary=.+/', $header);
    }
}
