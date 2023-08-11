<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class vBulletin  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->cookies as $cookie) {
            if (\mb_substr($cookie->name, 0, 7) === 'vb_last') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
