<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class LiveStreet  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        if (str_contains($site->content, 'Powered by <a href="http://livestreetcms.org">LiveStreet CMS</a>')) {
            $i++;
        }

        foreach ($site->headers as $header) {
            if ($header->name === 'x-generated-by' && $header->value === 'LiveStreet CMS') {
                $i++;
                continue;
            }
        }

        return $i;
    }
}
