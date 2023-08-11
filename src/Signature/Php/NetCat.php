<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class NetCat  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->headers as $header) {
            if ($header->name === 'x-netcat-version') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
