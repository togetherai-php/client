<?php

declare(strict_types=1);

namespace TogetherAI\Responses\Chat;

final class CreateResponseToolCall
{
    private function __construct(
        public readonly string $id,
        public readonly string $type,
        // function property
    ) {
        //
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['id'],
            $attributes['type'],
            // function creation
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            // function key => value
        ];
    }
}
