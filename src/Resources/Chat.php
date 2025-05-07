<?php

declare(strict_types=1);

namespace TogetherAI\Resources;

use TogetherAI\Contracts\Resources\ChatContract;
use TogetherAI\Responses\Chat\CreateResponse;
use TogetherAI\ValueObjects\Transporter\Payload;

final class Chat implements ChatContract
{
    use Concerns\Transportable;

    /**
     * Creates a completion for the chat message
     */
    public function create(array $parameters): CreateResponse
    {
        $payload = Payload::create('chat/completions', $parameters);

        $response = $this->transporter->requestObject($payload);

        return CreateResponse::from($response->data(), $response->meta());
    }
}
