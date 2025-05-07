<?php

declare(strict_types=1);

namespace TogetherAI\Responses\Chat;

final class CreateResponseMessage
{
    private function __construct(
        public readonly string $role,
        public readonly ?string $content,
        public readonly array $toolCalls,
        // TODO: ADD FUNCTION CALL PROERPTY
    ) {
        //
    }

    public static function from(array $attributes): self
    {
        $toolCalls = array_map(fn (array $result): CreateResponseToolCall => CreateResponseToolCall::from(
            $result
        ), $attributes['tool_calls'] ?? []);

        return new self(
            $attributes['role'],
            $attributes['content'] ?? null,
            $toolCalls,
            // TODO: ADD FUNCTION CALL
        );
    }

    public function toArray(): array
    {
        $data = [
            'role' => $this->role,
            'content' => $this->content,
        ];

        // TODO: ADD FUNCTION CALL KEY => VALUE.

        if ($this->toolCalls !== []) {
            $data['tool_calls'] = array_map(
                fn (CreateResponseToolCall $toolCall): array => $toolCall->toArray(), $this->toolCalls
            );
        }

        return $data;
    }
}
