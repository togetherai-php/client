<?php

namespace TogetherAI\Contracts;

use TogetherAI\ValueObjects\Transporter\Payload;
use TogetherAI\ValueObjects\Transporter\Response;

interface TransporterContract
{
    /**
     * Sends a request to a server
     *
     * @return Response<array<array key, mixed>|string
     *
     * @throws
     */
    public function requestObject(Payload $payload): Response;

    /**
     * Sends a content request to a server
     *
     * @throws
     */
    public function requestContent(Payload $payload): string;
}
