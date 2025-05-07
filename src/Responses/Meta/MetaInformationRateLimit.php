<?php

namespace TogetherAI\Responses\Meta;

final class MetaInformationRateLimit
{
    private function __construct(
        public readonly ?int $limit
    ) {
        //
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['limit'],
        );
    }
}
