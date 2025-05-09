<?php

declare(strict_types=1);

namespace TogetherAI\Client;

final class TogetherAI
{
    /**
     * Creates a new Together AI client with the give api token
     */
    public static function client(string $apiKey): Client
    {
        return self::factory()
            ->withApiKey($apiKey)
            ->withHttpHeader('stop', '["</s>","[/INST]"]')
            ->withHttpHeader('temperature', '0.7')
            ->withHttpHeader('top_p', '0.7')
            ->withHttpHeader('top_k', '50')
            ->withHttpHeader('repetition_penalty', '1')
            ->make();
    }

    public static function factory(): Factory
    {
        return new Factory;
    }
}
