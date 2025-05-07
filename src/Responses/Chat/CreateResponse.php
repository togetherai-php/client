<?php

declare(strict_types=1);

namespace TogetherAI\Responses\Chat;

use TogetherAI\Contracts\ResponseHasMetaInformationContract;
use TogetherAI\Responses\Concerns\HasMetaInformation;
use TogetherAI\Responses\Meta\MetaInformation;

final class CreateResponse implements ResponseHasMetaInformationContract
{
    use HasMetaInformation;

    private function __construct(
        public readonly string $id,
        public readonly string $object,
        public readonly int $created,
        public readonly string $model,
        public readonly ?string $systemfingerprint,
        public readonly array $choices,
        public readonly CreateResponseUsage $usage,
        private readonly MetaInformation $meta,
    ) {
        //
    }

    public static function from(array $attributes, MetaInformation $meta): self
    {
        $choices = array_map(fn (array $result): CreateResponseChoice => CreateResponseChoice::from(
            $result
        ), $attributes['choices']);

        return new self(
            $attributes['id'],
            $attributes['object'],
            $attributes['created'],
            $attributes['model'],
            $attributes['system_fingerprint'] ?? null,
            $choices,
            CreateResponseUsage::from($attributes['usage']),
            $meta,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'object' => $this->object,
            'created' => $this->created,
            'model' => $this->model,
            'system_fingerprint' => $this->systemfingerprint,
            'choices' => array_map(
                static fn (CreateResponseChoice $result): array => $result->toArray(),
                $this->choices,
            ),
            'usage' => $this->usage->toArray(),
        ], fn (mixed $value): bool => ! is_null($value));
    }
}
