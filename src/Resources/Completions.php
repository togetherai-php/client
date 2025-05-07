<?php

declare(strict_types=1);

namespace TogetherAI\Resources;

use TogetherAI\Contracts\Resources\CompletionsContract;
use TogetherAI\Responses\Chat\CreateResponse;

final class Completions implements CompletionsContract
{
    use Concerns\Transportable;

    public function create(array $parameters): CreateResponse
    {
        // TODO: COMPLETE THE COMPLETION METHOD...
    }
}
