<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class CakePHP  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'CAKEPHP') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
