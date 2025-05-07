<?php

declare(strict_types=1);

namespace TogetherAI\Contracts;

interface StringableContract
{
    /**
     * Returns the string representation of the object
     */
    public function toString(): string;
}
