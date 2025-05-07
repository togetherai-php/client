<?php

declare(strict_types=1);

namespace TogetherAI\ValueObjects\Transporter;

use TogetherAI\Enums\ContentType;
use TogetherAI\ValueObjects\ApiKey;

final class Headers
{
    /**
     * Creates a new headers value object
     */
    private function __construct(private readonly array $headers)
    {
        //
    }

    public static function create(): self
    {
        return new self([]);
    }

    /**
     * Create a new headers value object with the given API token.
     */
    public static function withAuthorization(ApiKey $apiKey): self
    {
        return new self([
            'Authorization' => "Bearer {$apiKey->toString()}",
        ]);
    }

    public function withContentType(ContentType $contentType, string $suffix = ''): self
    {
        return new self([
            ...$this->headers,
            'Content-Type' => $contentType->value.$suffix,
        ]);
    }

    /**
     * Creates a new heder value object, with newly added header
     */
    public function withCustomHeader(string $name, string $value): self
    {
        return new self([
            ...$this->headers,
            $name => $value,
        ]);
    }

    public function toArray(): array
    {
        return $this->headers;
    }
}
