<?php

namespace TogetherAI\Responses\Meta;

use TogetherAI\Contracts\MetaInformationContract;

final class MetaInformation implements MetaInformationContract
{
    private function __construct(
        public readonly MetaInformationTogetherAI $togetherai,
        public readonly ?MetaInformationRateLimit $tokenLimit,
    ) {
        //
    }

    public static function from(array $headers): self
    {
        $headers = array_change_key_case($headers, CASE_LOWER);

        $togetherai = MetaInformationTogetherAI::from([
            'model' => $headers['model'][0] ?? null,
        ]);

        if (isset($headers['max_tokens'])) {
            $tokenLimit = MetaInformationRateLimit::from([
                'limit' => $headers['max_tokens'] ?? null,
            ]);
        } else {
            $tokenLimit = null;
        }

        return new self(
            $togetherai,
            $tokenLimit,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'model' => $this->togetherai->model,
            'max_tokens' => $this->tokenLimit->limit ?? 512,
        ]);
    }
}
