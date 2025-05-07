<?php

declare(strict_types=1);

namespace TogetherAI\Responses\Chat;

final class CreateResponseUsage
{
    private function __construct(
        public readonly int $promptTokens,
        public readonly ?int $completionTokens,
        public readonly int $totalTokens,
    ) {
        //
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['prompt_tokens'],
            $attributes['completion_tokens'] ?? null,
            $attributes['total_tokens'],
        );
    }

    public function toArray(): array
    {
        return [
            'prompt_tokens' => $this->promptTokens,
            'completion_tokens' => $this->completionTokens,
            'total_tokens' => $this->totalTokens,
        ];
    }
}
