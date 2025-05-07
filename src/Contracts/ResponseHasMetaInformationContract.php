<?php

declare(strict_types=1);

namespace TogetherAI\Contracts;

use TogetherAI\Responses\Meta\MetaInformation;

interface ResponseHasMetaInformationContract
{
    public function meta(): MetaInformation;
}
