<?php

namespace TogetherAI\Contracts;

use TogetherAI\Contracts\Resources\ChatContract;
use TogetherAI\Contracts\Resources\CompletionsContract;

interface ClientContract
{
    public function completions(): CompletionsContract;

    public function chat(): ChatContract;
}
