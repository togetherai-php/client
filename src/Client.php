<?php

namespace TogetherAI\Client;

use TogetherAI\Contracts\ClientContract;
use TogetherAI\Contracts\Resources\ChatContract;
use TogetherAI\Contracts\TransporterContract;
use TogetherAI\Resources\Chat;

final class Client implements ClientContract
{
    /**
     * Creates a Client instance with the given API token
     */
    public function __construct(
        private readonly TransporterContract $transporter
    ) {}

    /**
     * Given a chat conversation, the model will return a chat completion response.
     *
     * @see
     */
    public function chat(): ChatContract
    {
        return new Chat($this->transporter);
    }
}
