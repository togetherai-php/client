<?php

declare(strict_types=1);

namespace TogetherAI\ValueObjects\Transporter;

final class QueryParams
{
    private function __construct(private readonly array $params)
    {
        //
    }

    public static function create(): self
    {
        return new self([]);
    }

    public function withParam(string $name, string|int $value): self
    {
        return new self([
            ...$this->params,
            $name => $value,
        ]);
    }

    public function toArray(): array
    {
        return $this->params;
    }
}
