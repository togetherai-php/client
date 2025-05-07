<?php

namespace TogetherAI\Contracts\Resources;

use TogetherAI\Responses\Chat\CreateResponse;

interface ChatContract
{
    /**
     * Creates a completion for the chat message
     *
     * @param  array<string, mixed>  $parameters
     */
    public function create(array $parameters): CreateResponse;
}
