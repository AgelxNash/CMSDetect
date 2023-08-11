<?php

declare(strict_types=1);

namespace AgelxNash\Cmsdetect\Signature\Php;

use AgelxNash\Cmsdetect\Dto\Site;
use AgelxNash\Cmsdetect\SignatureInterface;

class XenForo  implements SignatureInterface
{
    public function detect(Site $site): float
    {
        $i = 0;

        foreach ($site->cookies as $cookie) {
            if ($cookie->name === 'xf_session') {
                $i++;
                continue;
            }
        }

        $str = '<a href="https://xenforo.com" class="concealed">Forum software by XenForo';
        if (\mb_strpos($site->content, $str) !== false) {
            $i += 0.35;
        }

        return $i;
    }
}
