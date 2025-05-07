<?php

declare(strict_types=1);

namespace TogetherAI\ValueObjects\Transporter;

use TogetherAI\Contracts\StringableContract;

final class BaseUri implements StringableContract
{
    /**
     * Creates base URI value object
     */
    private function __construct(private readonly string $baseUri)
    {
        //
    }

    public static function from(string $baseUri): self
    {
        return new self($baseUri);
    }

    public function toString(): string
    {
        foreach (['http://', 'https://'] as $protocol) {
            if (str_starts_with($this->baseUri, $protocol)) {
                return "{$this->baseUri}/";
            }
        }

        return "https://{$this->baseUri}/";
    }
}
