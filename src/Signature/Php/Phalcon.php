<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Phalcon  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->headers as $header) {
            if ($header->name === 'x-powered-by' && $header->value === 'Phalcon (https://phalconphp.com/)') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
