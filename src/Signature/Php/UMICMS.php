<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class UMICMS  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;
        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'umicms_session') {
                $i++;
                continue;
            }
        }

        foreach ($site->headers as $header) {
            if ($header->name === 'x-generated-by' && $header->value === 'UMI.CMS') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
