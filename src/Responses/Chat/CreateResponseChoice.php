<?php

declare(strict_types=1);

namespace TogetherAI\Responses\Chat;

final class CreateResponseChoice
{
    private function __construct(
        public readonly int $index,
        public readonly CreateResponseMessage $message,
        public readonly ?string $finishReason
    ) {
        //
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['index'],
            CreateResponseMessage::from($attributes['message']),
            $attributes['finish_reason'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'index' => $this->index,
            'message' => $this->message->toArray(),
            'finish_reason' => $this->finishReason,
        ];
    }
}
