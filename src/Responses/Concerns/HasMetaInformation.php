<?php

namespace TogetherAI\Responses\Concerns;

use TogetherAI\Responses\Meta\MetaInformation;

trait HasMetaInformation
{
    public function meta(): MetaInformation
    {
        return $this->meta;
    }
}
