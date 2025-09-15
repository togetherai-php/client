<?php

namespace TogetherAI\Client\Tests\Concerns;

use Mockery;
use Psr\Http\Message\ResponseInterface;
use TogetherAI\Client;
use TogetherAI\Contracts\TransporterContract;
use TogetherAI\ValueObjects\ApiKey;
use TogetherAI\ValueObjects\Transporter\BaseUri;
use TogetherAI\ValueObjects\Transporter\Headers;
use TogetherAI\ValueObjects\Transporter\Payload;
use TogetherAI\ValueObjects\Transporter\QueryParams;
use TogetherAI\ValueObjects\Transporter\Response;

trait MocksTogetherAIClient
{
    public function mockClient(
        string $method,
        string $resource,
        array $params,
        Response|ResponseInterface|string $response,
        $methodName = 'requestObject',
        bool $validateParams = true
    ) {
        $transporter = Mockery::mock(TransporterContract::class);

        $transporter
            ->shouldReceive($methodName)
            ->once()
            ->withArgs(
                function (Payload $payload) use ($validateParams, $method, $resource, $params): bool {
                    $baseUri = BaseUri::from('api.togetherai.xyz/v1');
                    $headers = Headers::withAuthorization(ApiKey::from('api-key'));
                    $queryParams = QueryParams::create();

                    $request = $payload->toRequest($baseUri, $headers, $queryParams);

                    if ($validateParams) {
                        if (in_array($method, ['GET', 'DELETE'])) {
                            if ($request->getUri()->getQuery() !== http_build_query($params)) {
                                return false;
                            }
                        } else {
                            if ($request->getBody()->getContents() !== json_decode($params)) {
                                return false;
                            }
                        }
                    }

                    return $request->getMethod() === $method
                        && $request->getUri()->getPath() === "/v1/$resource";
                })->andReturn($response);

        return new Client($transporter);
    }

    public function mockStreamClient(string $method, string $resource, array $params, ResponseInterface $response, bool $validateParams = true)
    {
        return $this->mockClient(
            method: $method,
            resource: $resource,
            params: $params,
            response: $response,
            methodName: 'requestStream',
            validateParams: $validateParams
        );
    }
}
