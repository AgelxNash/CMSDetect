<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class HostCMS  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        return $i;
    }
}
