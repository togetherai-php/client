<?php

namespace TogetherAI\Responses\Meta;

final class MetaInformationTogetherAI
{
    private function __construct(
        public readonly ?string $model,
    ) {
        //
    }

    public static function from(array $attributes): self
    {
        return new self(
            $attributes['model'],
        );
    }
}
