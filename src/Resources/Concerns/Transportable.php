<?php

declare(strict_types=1);

namespace TogetherAI\Resources\Concerns;

use TogetherAI\Contracts\TransporterContract;

trait Transportable
{
    /**
     * Creates a client instance with the givben api token
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        //
    }
}
