<?php

declare(strict_types=1);

namespace TogetherAI\ValueObjects\Transporter;

use TogetherAI\Responses\Meta\MetaInformation;

final class Response
{
    private function __construct(
        private readonly array|string $data,
        private readonly MetaInformation $meta
    ) {
        //
    }

    /**
     * Creates a new response value object from the given data
     */
    public static function from(array|string $data, array $headers): self
    {
        $meta = MetaInformation::from($headers);

        return new self($data, $meta);
    }

    /**
     * Returns the response data
     */
    public function data(): array|string
    {
        return $this->data;
    }

    /**
     * Returns the meta information
     */
    public function meta(): MetaInformation
    {
        return $this->meta;
    }
}
