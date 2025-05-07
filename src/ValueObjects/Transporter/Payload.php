<?php

declare(strict_types=1);

namespace TogetherAI\ValueObjects\Transporter;

use Http\Discovery\Psr17Factory;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use TogetherAI\Enums\ContentType;
use TogetherAI\Enums\Method;
use TogetherAI\ValueObjects\ResourceUri;

final class Payload
{
    /**
     * Creates a new request value object
     */
    private function __construct(
        private readonly ContentType $contentType,
        private readonly Method $method,
        private readonly ResourceUri $uri,
        private readonly array $paramters = [],
    ) {
        //
    }

    public static function create(string $resource, array $paramters): self
    {
        $contentType = ContentType::JSON;
        $method = Method::POST;
        $uri = ResourceUri::create($resource);

        return new self($contentType, $method, $uri, $paramters);
    }

    /**
     * Creates a new Psr 7 Request instance
     */
    public function toRequest(BaseUri $baseUri, Headers $headers, QueryParams $queryParams): RequestInterface
    {
        $psr17Factory = new Psr17Factory;

        $body = null;

        $uri = $baseUri->toString().$this->uri->toString();

        $queryParams = $queryParams->toArray();

        if ($this->method === Method::GET) {
            $queryParams = [...$queryParams, ...$this->paramters];
        }

        if ($queryParams !== []) {
            $uri .= '?'.http_build_query($queryParams);
        }

        $headers = $headers->withContentType($this->contentType);

        if ($this->method === Method::POST) {
            if ($this->contentType === ContentType::MULTIPART) {
                // TODO: BUILD THE MULTIPART QUERY.
            } else {
                $body = $psr17Factory->createStream(json_encode($this->paramters, JSON_THROW_ON_ERROR));
            }
        }

        $request = $psr17Factory->createRequest($this->method->value, $uri);

        if ($body instanceof StreamInterface) {
            $request = $request->withBody($body);
        }

        foreach ($headers->toArray() as $name => $value) {
            $request = $request->withHeader($name, $value);
        }

        return $request;
    }
}
