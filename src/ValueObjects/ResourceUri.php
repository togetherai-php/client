<?php

declare(strict_types=1);

namespace TogetherAI\ValueObjects;

use TogetherAI\Contracts\StringableContract;

final class ResourceUri implements StringableContract
{
    /**
     * Creates a new ResourceUri value object
     */
    private function __construct(private readonly string $uri)
    {
        //
    }

    /**
     * Creates a new ResourceUri value object that creates the given resource.
     */
    public static function create(string $resource): self
    {
        return new self($resource);
    }

    public function toString(): string
    {
        return $this->uri;
    }

    // TODO: ADD THE REST OF THE RESOURCE METHODS.
}
