<?php

namespace TogetherAI\Client;

use TogetherAI\Contracts\ClientContract;
use TogetherAI\Contracts\Resources\ChatContract;
use TogetherAI\Contracts\Resources\CompletionsContract;
use TogetherAI\Contracts\TransporterContract;
use TogetherAI\Resources\Chat;
use TogetherAI\Resources\Completions;

final class Client implements ClientContract
{
    /**
     * Creates a Client instance with the given API token
     */
    public function __construct(private readonly TransporterContract $transporter)
    {
        //
    }

    /**
     * Given a prompt, the model will return one or more predicted completions, and can also return the probabilities
     * of alternative tokens at each position.
     *
     * @see
     */
    public function completions(): CompletionsContract
    {
        return new Completions($this->transporter);
    }

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
