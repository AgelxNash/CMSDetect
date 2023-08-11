<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class Grav  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 1;

        foreach ($site->cookies as $cookie) {
            if (\mb_strlen($cookie->name) === 17 && 0 === \mb_strpos($cookie->name, 'grav-site-')) {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
