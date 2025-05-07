<?php

namespace TogetherAI\Contracts\Resources;

use TogetherAI\Responses\Chat\CreateResponse;

interface CompletionsContract
{
    /**
     * Creates a completion for the chat message
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
