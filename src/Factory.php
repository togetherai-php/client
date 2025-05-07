<?php

namespace TogetherAI;

use GuzzleHttp\Psr7\Header;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use TogetherAI\Client\Client;
use TogetherAI\Transporters\HttpTransporter;
use TogetherAI\ValueObjects\ApiKey;
use TogetherAI\ValueObjects\Transporter\BaseUri;
use TogetherAI\ValueObjects\Transporter\Headers;
use TogetherAI\ValueObjects\Transporter\QueryParams;

final class Factory
{
    /**
     * The API key for the request
     */
    private ?string $apiKey = null;

    /**
     * The HTTP client for the requests.
     */
    private ?ClientInterface $httpClient = null;

    /**
     * The base URI for the requests
     */
    private ?string $baseUri = null;

    /**
     * The HTTP headers for the requests
     */
    private array $headers = [];

    /**
     * The query parameters for the requests
     */
    private array $queryParams = [];

    /**
     * sets the api key for the request
     */
    public function withApiKey(string $apiKey): self
    {
        $this->apiKey = trim($apiKey);

        return $this;
    }

    /**
     * Sets the HTTP client for the request
     */
    public function withHttpClient(ClientInterface $client): self
    {
        $this->httpClient = $client;

        return $this;
    }

    /**
     * Sets the base URI for the requests.
     */
    public function withBaseUri(string $baseUri): self
    {
        $this->baseUri = $baseUri;

        return $this;
    }

    /**
     * Adds a custom HTTP header to the requests.
     */
    public function withHttpHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;

        return $this;
    }

    public function withQueryParam(string $name, string $value): self
    {
        $this->queryParams[$name] = $value;

        return $this;
    }

    /**
     * Creates a new Open AI Client
     */
    public function make(): Client
    {
        $headers = Headers::create();

        if ($this->apiKey !== null) {
            $headers = Headers::withAuthorization(ApiKey::from($this->apiKey));
        }

        foreach ($this->headers as $name => $value) {
            $headers = $headers->withCustomHeader($name, $value);
        }

        $baseUri = BaseUri::from($this->baseUri ?: 'api.together.xyz/v1');

        $queryParams = QueryParams::create();
        foreach ($this->queryParams as $name => $value) {
            $queryParams = $queryParams->withParam($name, $value);
        }

        $client = $this->httpClient ??= Psr18ClientDiscovery::find();

        $transporter = new HttpTransporter($client, $baseUri, $headers, $queryParams);

        return new Client($transporter);
    }
}
