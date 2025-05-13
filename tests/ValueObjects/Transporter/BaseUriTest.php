<?php

namespace Tests\ValueObjects\Transporter;

use TogetherAI\Client\Tests\TestCase;
use TogetherAI\ValueObjects\Transporter\BaseUri;

class BaseUriTest extends TestCase
{
    /** @test */
    public function it_can_be_created_from_string(): void
    {
        $baseUri = BaseUri::from('api.togetherai.xyz/v1');

        $this->assertEquals('https://api.togetherai.xyz/v1/', $baseUri->toString());
    }

    /** @test */
    public function it_can_be_created_from_a_string_with_http_protocol(): void
    {
        $baseUri = BaseUri::from('http://api.togetherai.xyz/v1');

        $this->assertEquals('http://api.togetherai.xyz/v1/', $baseUri->toString());
    }

    /** @test */
    public function it_can_be_created_from_a_string_with_https_protocol(): void
    {
        $baseUri = BaseUri::from('https://api.togetherai.xyz/v1');

        $this->assertEquals('https://api.togetherai.xyz/v1/', $baseUri->toString());
    }
}
