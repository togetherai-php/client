<?php

namespace TogetherAI\Contracts;

use TogetherAI\Contracts\Resources\ChatContract;

interface ClientContract
{
    public function chat(): ChatContract;
}
