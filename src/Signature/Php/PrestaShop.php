<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class PrestaShop  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->headers as $header) {
            if ($header->name === 'powered-by' && $header->value === 'PrestaShop') {
                $i++;
                continue;
            }
        }

        foreach ($site->cookies as $cookie) {
            if (0 === \mb_strpos($cookie->name, 'PrestaShop')) {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
